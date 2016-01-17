<?php session_start(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Virtual Mirror</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.ui.rotatable.js"></script>

		<script src="js/vendor/jquery.carouFredSel-6.2.0.js"></script>

		<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
        <script type="text/javascript" src="js/vendor/plupload/plupload.full.js"></script>

        <script type="text/javascript" src="js/vendor/webcam/jquery.webcam.js"></script>

        <link rel="stylesheet" href="js/vendor/reveal/reveal.css">
        <script type="text/javascript" src="js/vendor/reveal/jquery.reveal.js"></script>

        <script src="js/main.js"></script>

    </head>
    <body>

        <?php include 'virtual_mirror.php'; ?> <!-- main Tool loaded here -->
        
		<script>
			try_mirror("<?php echo $_REQUEST['file']; ?>");
			
			window.setTimeout(function()
			{
				window.setInterval(function()
				{
					if ('hidden' == $('#mirror-modal').css('visibility'))
					{
						window.parent.hideMirror();
					}
				}, 100);
			}, 1000);
		</script>
    </body>
</html>
