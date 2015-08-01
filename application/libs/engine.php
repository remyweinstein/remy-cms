<?php
class Engine {
    static public $curTemplate;
    static public $curAdmin;
    static public $curController;
    static public $curUrlName;
    static public $curIdPage;
    static public $contenteditable;
    static public $settings;
    static public $user;
    static public $Module;

    public function __construct() {
    }
	
    public static function init() {
        self::$user = new User;
        self::$curAdmin = false;
        foreach(dB::getAllSettings() as $key => $value) {
            self::$settings[$value['name']] = $value['value'];
        }
        self::$contenteditable = '';
        self::$curTemplate = self::$settings['default_template'];
	}
        
    public static function run() {
        $current_controller = self::$curController . '_controller';
        self::$Module = new $current_controller;
        self::changeTitle(self::$Module->title);
        if(self::$curTemplate == "none") {
            echo self::$Module->content;
        } else {
            require_once (TEMPLATES.self::$curTemplate.'/template.php');
        }
    }
    
    private function changeTitle($title) {
        self::$settings['var_meta_title'] = $title=="" ? self::$settings['var_meta_title'] : $title.' - '.self::$settings['var_meta_title'];
    }
        
    public static function getLayout($layout, $data=null) {
        if(file_exists(TEMPLATES.self::$curTemplate.'/'.$layout.'_layout.php')) { 
            $path = TEMPLATES.self::$curTemplate.'/';
        } elseif(file_exists(APP_VIEWS.$layout.'_layout.php')) {
            $path = APP_VIEWS;
        }
        if($path) {
            ob_start();
            include $path.$layout.'_layout.php';
            $content = ob_get_contents();
            ob_end_clean();
        }
        return $content;
    }

    public static function getConfigIni() {
        if (file_exists('config.ini.php')) {
            $config = parse_ini_file('config.ini.php', true);
            define('HOST', $config['DB']['HOST']);
            define('USER', $config['DB']['USER']);
            define('PASSWORD', $config['DB']['PASSWORD']);
            define('NAME_BD', $config['DB']['NAME_BD']);
            define('PREFIX', $config['DB']['TABLE_PREFIX']);
            define('LOCAL_SALT', $config['CRYPT']['LOCAL_SALT']);
			
            return true;
	}
	return false;
    }
	
    public static function BreadCrumbs($page,$title) {
        if($page != "index") {
            $parent = dB::getParentByUrl($page);
            if($parent) {
		$content = '<a href="'.self::$settings['main_host'].$parent['url'].'/">'.$parent['title'].'</a> > '.$content;
		if($parent['parent'] > 0) {
                    $next_content = Engine::BreadCrumbs($parent['url'],"");
                    $content = $next_content.$content;
		}
            }
            $content = ($title != "") ? '<a href="/">Главная</a> > '.$content : $content;
        } else {
            $content = "";
        }
            
        return $content;
    }
	
    public static function DirectLink($link) {
	header("Location: ".$link);
	exit('<script>
		location.href = "'.$link.'";
		</script>
		');
    }

    public static function PaginatorView($active_page, $count_item, $display_of, $link, $paginator) {
    	$count_page = round($count_item/$display_of) + 1;
    	$content = '<div style="width:100%;text-align:center;"><ul class="pagination">';
    	$content .= ($active_page<=1) ? '<li class="prev disabled"><a href="#"> ← Previous</a></li>' : '<li><a href="'.$link.'&'.$paginator.'='.($active_page-1).'"> ← Previous</a></li>';    	
    	for($i=0;$i<$count_page;$i++) {
            $content .= ($active_page == ($i+1)) ? '<li class="active"><a href="#">'.($i+1).'</a></li>' : '<li><a href="'.$link.'&'.$paginator.'='.($i+1).'">'.($i+1).'</a></li>';
    	}            	
    	$content .= ($active_page>=$count_page) ? '<li class="next disabled"><a href="#">Next → </a></li>' : '<li><a href="'.$link.'&'.$paginator.'='.($active_page+1).'">Next → </a></li>';
    	$content .= '</ul></div>';

    	return $content;
    }

    public static function UploadFile($file) {
	$result = '';
	$file_name = mt_rand(111111, 999999).'_'.$file["name"];
       	if(is_uploaded_file($file["tmp_name"])) {
            $result = (move_uploaded_file($file["tmp_name"], $_SERVER[DOCUMENT_ROOT].'/'.Engine::$settings['directory_pictures'].'/'.$file_name)) ? $file_name : '';
    	}

    	return $result;
    }
	
}