<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(dirname(dirname(__file__))));

$_GET['noRewrite'] = true;
$_SERVER['virtualBaseDir'] = getcwd();
$_SERVER['baseDir'] = getcwd() . '/public/';

$_GET['id'] = $_REQUEST['id'] = 5;
$_GET['route'] = 'backend.cloneSync/sync';
$_SESSION['User'] = 1;
$_SESSION['UserGroup'] = 1;

echo 'test';

include './public/index.php';

echo 'done';

?>
