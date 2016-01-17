<?php

ClassLoader::import("application.controller.backend.abstract.BackendController");
ClassLoader::import("module.store-cloning.application.controller.ClonedApiController");
ClassLoader::import("module.store-cloning.application.model.ClonedStore");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreCategory");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreRule");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreUpdater");

class CloneSyncController extends BackendController
{
	public function sync()
	{
		if ($this->config->get('CLONE_STORE_TYPE') != 'CLONE_STORE_MASTER')
		{
			return new RawResponse('Synchronization is only allowed from the master store');
		}

		ob_clean();
		ob_end_clean();

?>

<html>
	<head>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
			window.waitForCompletion = function()
			{
				jQuery.ajax('status').always(function(data)
					{
						var res = jQuery.parseJSON(data.responseText);

						jQuery.each(res, function(key, value)
						{
							if (value)
							{
								jQuery('#store_' + key).removeClass('processing').addClass('done');
							}
						});

						if (!res.ready)
						{
							window.setTimeout(window.waitForCompletion, 2000);
						}
						else
						{
							jQuery('#main').removeClass('processing').addClass('done').html('Update completed!');
						}
					});
			};
		</script>
		<style type="text/css">
			.processing
			{
				padding-left: 25px;
				background-image: url(../public/image/indicator.gif);
				background-position: left center;
				background-repeat: no-repeat;
			}

			.done
			{
				color: green;
			}
		</style>
	</head>
	<body>
<?php

//echo str_repeat('<!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ->', 100);
flush();

		echo '<h2 id="main" class="processing">Initializing update</h2>';
		flush();

		set_time_limit(0); error_reporting(E_ALL); ini_set('display_errors', 1);

		$updater = new ClonedStoreUpdater($this->application, 'galssess_snapshot');
flush();

		if ($id = $this->request->get('id'))
		{
			$select = select(eq(f('ClonedStore.ID'), $id));
		}
		else
		{
			$select = select();
		}
		
		if ($this->request->get('override'))
		{
			$updater->setOverride();
		}

		$updater->syncAll($select);

//echo str_repeat('<!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ->', 100);
flush();

		foreach (ActiveRecord::getRecordSet('ClonedStore', $select) as $key => $store)
		{
			echo '<h2  class="processing" id="store_' . $store->getID() . '">' . $store->domain->get() . '</h2>';
			echo '<div>Uploading data</div>';

			flush();

			$store->pushData();

			echo '<div>Starting update</div>';

			$store->initUpdate();
			flush();

			if (2 == $key)
			{
				//break;
			}
		}

		?>
		<script type="text/javascript">
			window.waitForCompletion();
		</script>

		</body></html>
		<?php
	}

	public function status()
	{
		$status = array();

		foreach (ActiveRecord::getRecordSet('ClonedStore', select()) as $store)
		{
			$f = new NetworkFetch('http://' . $store->domain->get() . '/storeSync/status');
			$f->fetch();
			$status[$store->getID()] = (file_get_contents($f->getTmpFile()) == 'true');
		}

		$status['ready'] = (count($status) == count(array_filter($status)));

		return new JSONResponse($status);
	}
}

?>
