{
	"items":
	{
		"stores":
		{
			"title": "Stores",
			"controller": "backend.clonedStore",
			"icon": "image/silk/asterisk_orange.png",
			"descr": "Manage cloned stores",
			"items":
			{
				"storeUpdate":
				{
					"title": "Init synchronization",
					"controller": "backend.cloneSync",
					"action": "sync",
					"icon": "image/silk/asterisk_orange.png",
					"descr": "Initialize data synchronization to cloned stores"
				}
			}
		}
	}
}
