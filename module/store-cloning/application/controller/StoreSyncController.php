<?php

ClassLoader::import("application.model.ObjectFile");
ClassLoader::import("application.controller.backend.abstract.BackendController");
ClassLoader::import("application.controller.backend.ProductImageController");
ClassLoader::import("module.store-cloning.application.controller.ClonedApiController");
ClassLoader::import("module.store-cloning.application.model.ClonedStore");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreCategory");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreRule");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreUpdater");

ClassLoader::import('application.model.system.Installer');

class StoreSyncController extends BaseController
{
	public function queue()
	{
		ini_set('memory_limit', '512M');
			
		if ($this->request->get('password') != $this->config->get('CLONE_STORE_API_KEY'))
		{
			return new RawResponse('Wrong password: ') . $this->request->get('password');
		}

		$fetch = new NetworkFetch($this->request->get('url') . '?file=' . urlencode($this->request->get('fileName')) . '&id=' . $this->request->get('id') . '&password=' . md5($this->config->get('CLONE_STORE_API_KEY')));
		$fetch->setAuth('admin', 'Cloning123!');
		$fetch->fetch();

		// validate hash
		$hashFetch = new NetworkFetch($this->request->get('hashUrl') . '?file=' . urlencode($this->request->get('fileName')) . '&id=' . $this->request->get('id') . '&password=' . md5($this->config->get('CLONE_STORE_API_KEY')));
		$hashFetch->setAuth('admin', 'Cloning123!');
		$hashFetch->fetch();
		if (md5_file($fetch->getTmpFile()) == file_get_contents($hashFetch->getTmpFile()))
		{
			rename($fetch->getTmpFile(), $this->getFileDir() . $this->request->get('fileName'));
			return new RawResponse('OK');
		}
		else
		{
			return new RawResponse('MD5 mismatch ' . file_get_contents($hashFetch->getTmpFile()) . ' ' . substr(file_get_contents($fetch->getTmpFile()) . ' ' . filesize($fetch->getTmpFile()), -200));
		}
	}

	public function import()
	{
		$this->application->setDevMode(true);
		ignore_user_abort(true);
		ini_set('memory_limit', '512M');
		set_time_limit(0);

		if ($this->request->get('password') != $this->config->get('CLONE_STORE_API_KEY'))
		{
			return new RawResponse('Wrong password');
		}

		ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=0;');
		ActiveRecord::getLogger()->setLogFileName(null);

		$dir = $this->getFileDir();

		//if (ob_get_length())
		//{
			ob_flush();
			ob_end_clean();
		//}

		//echo str_repeat('FLUSH ', 10000);

		foreach (scandir($dir) as $file)
		{
			if (strlen($file) < 3)
			{
				continue;
			}

			$path = $dir . $file;

			if (substr($file, -4) == '.sql')
			{
				$f = fopen($path, 'r');
				$prev = '';
				while (!feof($f))
				{
					$s = $prev . fread($f, 1024*1024);

					if (!feof($f))
					{
						$pos = strrpos($s, ";\n");
						$prev = substr($s, $pos + 1);
						$s = substr($s, 0, $pos);
					}

					Installer::loadDatabaseDump($s, true);
				}
			}
			else
			{
				$this->untar($path, ClassLoader::getRealPath('public.upload.'));
			}

			unlink($path);
		}

		$this->user->allowBackendAccess();
		$c = new ProductImageController($this->application);
		$c->resizeImages();

		Category::reindex();
		Category::recalculateProductsCount();
	}

	private function untar($file, $dest = "./") {
	if (!is_readable($file)) return false;

	$filesize = filesize($file);

	// Minimum 4 blocks
	if ($filesize <= 512*4) return false;

	if (!preg_match("/\/$/", $dest)) {
	// Force trailing slash
	$dest .= "/";
	}

	//Ensure write to destination
	if (!file_exists($dest)) {
	if (!mkdir($dest, 0777, true)) {
	return false;
	}
	}

	$fh = fopen($file, 'rb');
	$total = 0;
	while (false !== ($block = fread($fh, 512))) {

	$total += 512;
	$meta = array();
	// Extract meta data
	// http://www.mkssoftware.com/docs/man4/tar.4.asp
	$meta['filename'] = trim(substr($block, 0, 99));
	$meta['mode'] = octdec((int)trim(substr($block, 100, 8)));
	$meta['userid'] = octdec(substr($block, 108, 8));
	$meta['groupid'] = octdec(substr($block, 116, 8));
	$meta['filesize'] = octdec(substr($block, 124, 12));
	$meta['mtime'] = octdec(substr($block, 136, 12));
	$meta['header_checksum'] = octdec(substr($block, 148, 8));
	$meta['link_flag'] = octdec(substr($block, 156, 1));
	$meta['linkname'] = trim(substr($block, 157, 99));
	$meta['databytes'] = ($meta['filesize'] + 511) & ~511;

	if ($meta['link_flag'] == 5) {
	// Create folder
	mkdir($dest . $meta['filename'], 0777, true);
	chmod($dest . $meta['filename'], $meta['mode']);
	}

	if ($meta['databytes'] > 0) {
	$block = fread($fh, $meta['databytes']);
	// Extract data
	$data = substr($block, 0, $meta['filesize']);

	$dir = dirname($dest . $meta['filename']);
	if (!file_exists($dir))
	{
		mkdir($dir, 0777, true);
	}

	// Write data and set permissions
	if (false !== ($ftmp = fopen($dest . $meta['filename'], 'wb'))) {
	fwrite($ftmp, $data);
	fclose($ftmp);
	touch($dest . $meta['filename'], $meta['mtime'], $meta['mtime']);

	if ($meta['mode'] == 0744) $meta['mode'] = 0644;

	chmod($dest . $meta['filename'], $meta['mode']);
	echo '. '; flush();
	}
	$total += $meta['databytes'];
	}

	if ($total >= $filesize-1024) {
	return true;
	}
	}
	}

	public function fileList()
	{
		if ($this->request->get('password') != $this->config->get('CLONE_STORE_API_KEY'))
		{
			return new RawResponse('Wrong password');
		}

		$root = ClassLoader::getRealPath('public.upload.');
		$l = strlen($root) + 1;
		$files = array();
		foreach ($this->find_all_files($root) as $file)
		{
			$files[substr($file, $l)] = filemtime($file);
		}

		file_put_contents(ClassLoader::getRealPath('public.cache.fileList'), json_encode($files));

		return new RedirectResponse('/public/cache/fileList');
	}

	protected function find_all_files($dir)
	{
		$root = scandir($dir);
		$result = array();
		foreach($root as $value)
		{
			if (!strpos("$dir/$value", 'image')) { continue; }
			if($value === '.' || $value === '..') {continue;}
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
			foreach($this->find_all_files("$dir/$value") as $value)
			{
				$result[]=$value;
			}
		}
		return $result;
	}

	protected function getFileDir()
	{
		$dir = ClassLoader::getRealPath('storage.importQueue.');

		if (!file_exists($dir))
		{
			mkdir($dir);
		}

		return $dir;
	}

	public function file()
	{
		$file = $this->getStoreFile();

		if ($file instanceof RawResponse)
		{
			return $file;
		}
error_reporting(E_ALL);ini_set('display_errors', 'On');

		ob_clean();
		ob_end_clean();
		header('Content-Disposition: attachment; filename="test"');
		header('Content-type: text/html');

		if (file_exists($file))
		{
			$f = fopen($file, 'r');
			while (!feof($f))
			{
				echo fread($f, 10000);
				flush();
			}

			fclose($f);
			exit;
		}
	}

	public function fileHash()
	{
		$file = $this->getStoreFile();

		if ($file instanceof RawResponse)
		{
			return $file;
		}

		if (file_exists($file))
		{
			return new RawResponse(md5_file($file));
		}
	}

	public function delFile()
	{
		$file = $this->getStoreFile();

		if ($file instanceof RawResponse)
		{
			return $file;
		}

		if (file_exists($file))
		{
			unlink($file);
			return new RawResponse('OK');
		}
	}

	public function status()
	{
		$count = count(scandir($this->getFileDir())) - 2;
		return new JSONResponse($count <= 0);
	}

	protected function getStoreFile()
	{
		$store = ActiveRecordModel::getInstanceByID('ClonedStore', $this->request->get('id'), true);

		if ($this->request->get('password') != md5($store->apiKey->get()))
		{
			return new RawResponse('Wrong password');
		}

		return $store->getFileDir() . '/' . $this->request->get('file');
	}
}

?>
