<?php

Error_Reporting(1);
session_start();
header('Content-Type: text/html; charset=utf-8');

define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'].'/');
define('CORE_DIR', 'application/');
define('CORE_LIB', CORE_DIR.'core/');
define('CORE_MODELS', CORE_DIR.'models/');
define('CORE_VIEWS', CORE_DIR.'views/');
define('CORE_CONTROLS', CORE_DIR.'controllers/');
define('ADMIN_DIR', 'admin/');
define('ADMIN_LIB', ADMIN_DIR.'core/');
define('ADMIN_MODELS', ADMIN_DIR.'models/');
define('ADMIN_VIEWS', ADMIN_DIR.'views/');
define('ADMIN_CONTROLS', ADMIN_DIR.'controllers/');
define('TEMPLATES', 'templates/');
define('PAGE_DIR', 'pages/');
define('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HOST_RES', HTTP_HOST.'resources/');

$includePath = array(CORE_DIR, CORE_LIB, CORE_MODELS, CORE_CONTROLS, ADMIN_LIB, ADMIN_MODELS, ADMIN_CONTROLS);
set_include_path('.'.PATH_SEPARATOR.implode(PATH_SEPARATOR, $includePath));

function __autoload($className) {
	$path = str_replace('_', '/', strtolower($className));
	return include_once $path.'.php';
}

require_once ('bootstrap.php');
