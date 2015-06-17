<?php

Error_Reporting(1);
session_start();
header('Content-Type: text/html; charset=utf-8');

define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'].'/');
define('CORE_DIR', 'core/');
define('CORE_LIB', CORE_DIR.'classes/');
define('CORE_MODELS', CORE_LIB.'models/');
define('CORE_VIEWS', CORE_LIB.'views/');
define('ADMIN_DIR', 'admin/');
define('ADMIN_LIB', ADMIN_DIR.'classes/');
define('ADMIN_MODELS', ADMIN_LIB.'models/');
define('ADMIN_VIEWS', ADMIN_LIB.'views/');
define('TEMPLATES', 'templates/');
define('PAGE_DIR', 'pages/');
define('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HOST_RES', HTTP_HOST.'resources/');

$includePath = array(CORE_DIR, CORE_LIB, CORE_MODELS, ADMIN_LIB, ADMIN_MODELS);
set_include_path('.'.PATH_SEPARATOR.implode(PATH_SEPARATOR, $includePath));

function __autoload($className) {
	$path = str_replace('_', '/', strtolower($className));
	return include_once $path.'.php';
}

require_once ('core.php');
