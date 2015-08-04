<?php

error_reporting(1);

session_start();
header('Content-Type: text/html; charset=utf-8');

define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'].'/');

define('APP_DIR', 'application/');
define('APP_LIBS', APP_DIR.'libs/');
define('APP_MODELS', APP_DIR.'models/');
define('APP_CONTROLS', APP_DIR.'controllers/');
define('APP_VIEWS', APP_DIR.'views/');

define('ADMIN_DIR', 'admin/');
define('ADMIN_VIEWS', ADMIN_DIR.'views/');

define('TEMPLATES', 'templates/');
define('PAGE_DIR', 'pages/');
define('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HOST_RES', HTTP_HOST.'resources/');
define('HOST_SCRIPTS', HTTP_HOST.'scripts/');

$includePath = array(APP_LIBS, APP_MODELS, APP_CONTROLS);
set_include_path('.'.PATH_SEPARATOR.implode(PATH_SEPARATOR, $includePath));

function __autoload($className) {
	$path = strtolower($className);
	return include_once $path.'.php';
}

require_once (APP_DIR . 'bootstrap.php');