<?php

ClassLoader::import("application.model.ActiveRecordModel");

/**
 * @author Integry Systems <http://integry.com>
 */
class ClonedStore extends ActiveRecordModel
{
	private $queuedQueries = array();

	public static function defineSchema($className = __CLASS__)
	{
		$schema = self::getSchemaInstance($className);
		$schema->setName(__CLASS__);

		$schema->registerField(new ARPrimaryKeyField("ID", ARInteger::instance()));
		$schema->registerField(new ARField("domain", ARVarchar::instance(100)));
		$schema->registerField(new ARField("apiKey", ARVarchar::instance(100)));
		$schema->registerField(new ARField("lastImport", ARDateTime::instance()));
	}

	public static function getNewInstance()
	{
		return parent::getNewInstance(__CLASS__);
	}

	protected function getUpdateDirectory()
	{
		return ClassLoader::getRealPath('storage.clonedImport.') . $this->getID();
	}

	public function addQuery($sql)
	{
		if (substr($sql, -1) != ';')
		{
			$sql .= ';';
		}

		file_put_contents($this->getQueryFile(), $sql . "\n", FILE_APPEND | LOCK_EX);
	}

	public function addQueuedQuery($sql)
	{
		$this->queuedQueries[] = $sql;
	}

	public function writeQueuedQueries()
	{
		foreach ($this->queuedQueries as $sql)
		{
			$this->addQuery($sql);
		}

		$this->queuedQueries = array();
	}

	public function getQueryFile($ext = '.sql')
	{
		$queryFile = $this->getFileDir() . '/'. $this->lastImport->get() . $ext;

		if (!file_exists(dirname($queryFile)))
		{
			mkdir(dirname($queryFile), 0777, true);
		}

		return $queryFile;
	}

	public function getFileDir()
	{
		return ClassLoader::getRealPath('storage.cloneSyncSQL.') . $this->getID();
	}

	public function setFileList($files)
	{
		// get file list from store
		$url = 'http://' . $this->domain->get() . '/storeSync/fileList';
		$params = array('password' => $this->apiKey->get());

		//$u = $url . '?password=' . $this->apiKey->get();
		//$res = file_get_contents($u);
		echo '<span style="font-size: 2px">.</span>';

		$res = $this->httpPost($url, $params);

		if (is_null($res))
		{
			return;
		}

		echo '<span style="font-size: 2px">.</span>';

		$res = json_decode($res, true);
		
		if (is_null($res))
		{
			return;
		}

		echo '<span style="font-size: 2px">.</span>';

		// get ID's of images actually used
		$ids = array();
		foreach (ActiveRecord::getDataBySQL('SELECT ID FROM galssess_snapshot_import.ProductImage') as $id)
		{
			$ids[$id['ID']] = true;
		}

		echo '<span style="font-size: 2px">.</span>';

		// filter out files that are not needed to update
		foreach ($files as $file => $time)
		{
			if (!empty($res[$file]) && $res[$file] >= $time)
			{
				unset($files[$file]);
			}
			else if (strpos($file, 'roductimage'))
			{
				list($productId, $id, $foo) = explode('-', $file, 3);
				if (!isset($ids[$id]))
				{
					unset($files[$file]);
				}
			}
		}

		echo '<span style="font-size: 2px">.</span>';

		$cd = getcwd();
		chdir(ClassLoader::getRealPath('public.upload'));

		echo '<span style="font-size: 2px">.</span>';

		$tar = $this->getQueryFile('.tar');
		exec('tar cvf "' . $tar . '" --files-from /dev/null');

		echo '<span style="font-size: 2px">.</span>';

		foreach ($files as $file => $time)
		{
			exec('tar rvf "' . $tar .'" ' . $file);
			echo '<span style="font-size: 2px">.</span>';
		}

		echo '<span style="font-size: 2px">.</span>';
		chdir($cd);
		echo '<span style="font-size: 2px">.</span>';
	}

	public function pushData()
	{
		set_time_limit(0);

		$url = 'http://' . $this->domain->get() . '/storeSync/queue';
		$router = ActiveRecordModel::getApplication()->getRouter();
		$filePushUrl = $router->createFullUrl($router->createUrl(array('controller' => 'storeSync', 'action' => 'file')));
		$fileHashUrl = $router->createFullUrl($router->createUrl(array('controller' => 'storeSync', 'action' => 'fileHash')));

		$filePushUrl = 'http://www.galssesspot.com/storeSync/file';
		$fileHashUrl = 'http://www.galssesspot.com/storeSync/fileHash';

		$dir = $this->getFileDir();
		foreach (array_diff(scandir($this->getFileDir()), array('.', '..')) as $file)
		{
			for ($attempts = 1; $attempts++; $attempts <= 10)
			{
				$params = array('password' => $this->apiKey->get());
				$params['fileName'] = basename($file);
				$params['id'] = $this->getID();
				$params['url'] = $filePushUrl;
				$params['hashUrl'] = $fileHashUrl;

				$res = $this->httpPost($url, $params);

				if ('OK' == $res)
				{
					unlink($this->getFileDir() . '/' . $file);
					break;
				}
				else
				{
					if (10 == $attempts)
					{
						var_dump($res);
					}
				}
			}
		}

		return count(scandir($this->getFileDir())) == 2;
	}

	public function initUpdate()
	{
		$url = 'http://' . $this->domain->get() . '/storeSync/import';

		$params = array('password' => $this->apiKey->get());
		$res = $this->httpPost($url, $params, array(CURLOPT_TIMEOUT => 2));
	}

	function httpPost($url, array $post = NULL, array $options = array())
	{
		$defaults = array(
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $url,
			CURLOPT_FRESH_CONNECT => 1,
			CURLOPT_CONNECTTIMEOUT => 60,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FORBID_REUSE => 1,
			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_POSTFIELDS => http_build_query($post)
		);

		$ch = curl_init();
		curl_setopt_array($ch, ($options + $defaults));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'admin:Cloning123!');

		$result = curl_exec($ch);

		//var_dump(curl_getinfo($ch));
		//var_dump($post);
		//var_dump(curl_error($ch));

		curl_close($ch);

		return $result;
	}
}

?>
