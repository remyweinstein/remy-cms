<?php

class Url {

	static private $cutPath = '';
	static public $documentRoot = '';
	
	public function __construct() {
	}
	
	public static function init() {
		
		self::$documentRoot = str_replace(DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'libs', '', dirname(__FILE__));
		self::$cutPath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
		
		if (get_magic_quotes_gpc()) {
			$_REQUEST = self::stripslashesArray($_REQUEST);
			$_POST = self::stripslashesArray($_POST);
			$_GET = self::stripslashesArray($_GET);
			$_REQUEST = self::stripXss($_REQUEST);
			$_POST = self::stripXss($_POST);
			$_GET = self::stripXss($_GET);
		}
		
		Engine::$curController = 'page';
		Engine::$curUrlName = 'index';
		
		$uri = mb_substr($_SERVER['REQUEST_URI'], 1);
		$uri = $uri=="/" ? "" : $uri;
		if($uri!="") {
			$sections = explode('?', rtrim($uri, '/'));
			$sections[0] = mb_substr($sections[0], -1)=='/' ? mb_substr($sections[0], 0, -1) : $sections[0];
			$catalogies = explode('/', $sections[0]);
			switch (count($catalogies)) {
				case 1:
					switch($catalogies[0]) {
						case "admin":
                                                    Engine::$curAdmin = true;
                                                    Engine::$curController = "dashboard";
                                                    Engine::$curUrlName = "dashboard";
                                                    Engine::$curTemplate = "admin";
                                                    break;
						case "login":
                                                    Engine::$curController = "auth";
                                                    Engine::$curUrlName = 'login';
                                                    break;
						case "registration":
                                                    Engine::$curController = "auth";
                                                    Engine::$curUrlName = 'registration';
                                                    break;
						default:
                                                    Engine::$curController = self::clearSection($catalogies[0]);
                                                    break;
					}
					break;
				case 2:
					switch($catalogies[0]) {
						case "admin":
                                                    Engine::$curAdmin = true;
                                                    Engine::$curController = self::clearSection($catalogies[1]);
                                                    Engine::$curUrlName = self::clearSection($catalogies[1]);
                                                    Engine::$curTemplate = "admin";
                                                    break;
						case "login":
                                                    Engine::$curController = "auth";
                                                    Engine::$curUrlName = 'login';
                                                    break;
						case "registration":
                                                    Engine::$curController = "auth";
                                                    Engine::$curUrlName = 'registration';
                                                    break;
						default:
                                                    if(class_exists(self::clearSection($catalogies[0]) . '_controller')) {
							Engine::$curController = self::clearSection($catalogies[0]);
                                                    }
                                                    Engine::$curUrlName = self::clearSection($catalogies[1]);
                                                    break;
					}
					break;
			}
			if(!class_exists(Engine::$curController . '_controller')) {
				Engine::$curController = 'page';
				Engine::$curUrlName = Engine::$settings['error_page'];
			}
		}
		define('HOST_TEMPL', HTTP_HOST.TEMPLATES.Engine::$curTemplate.'/');
                Engine::$curController = Engine::$curController . '_controller';
	}

	public static function stripslashesArray($array) {
		if (is_array($array))
			return array_map(array(__CLASS__, 'stripslashesArray'), $array);
		else
			return stripslashes($array);
	}
	
	public static function stripXss($arr) {
		$filter = array('<', '>');
		foreach ($arr as $num => $xss) {
			if (is_array($xss)) {
				$arr[$num] = self::defenderXss($xss);
			} else{
				$xss = str_replace('"', '&quot;', $xss);
				$arr[$num] = str_replace($filter,  array('&lt;', '&gt;'),  trim($xss));
			}
		}
	
		return $arr;
	}	
	
	private static function clearSection($url) {
		$notAllow = Array('/', '\\', '"', ':', '&', '*', '?', '<', '>', '|');
		$url = str_replace($notAllow, '', $url);
		$url = str_replace(array('.html','.htm','.php','/'), '', $url);
		return $url;
	}
	
}