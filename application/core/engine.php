<?php
class Engine {
	static public $curTemplate;
	static public $curAdmin;
	static public $curModule;
	static public $curUrlName;
	static public $curIdPage;
	static public $contenteditable;
	static public $settings;
	
	public function __construct() {

	}
	
	public static function init() {
		self::$curAdmin = false;
		foreach(dB::getAllSettings() as $key => $value) {
			self::$settings[$value['name']] = $value['value'];
		}
		self::$contenteditable = '';
		self::$curTemplate = self::$settings['default_template'];
		
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
		$content = ($title != "") ? $title : '';
		$parent = dB::getParentByUrl($page);
		if($parent) {
			$content = '<a href="'.self::$settings['main_host'].$parent['url'].'/">'.$parent['title'].'</a> > '.$content;
			if($parent['parent'] > 0) {
				$next_content = Engine::BreadCrumbs($parent['url'],"");
				$content = $next_content.$content;
			}
		}
		$content = ($title != "") ? '<a href="/">Главная</a> > '.$content : $content;
		return $content;
	}
	
	public static function DirectLink($link) {
		header("Location: ".$link);
		exit('<script>
			location.href = "'.$link.'";
			</script>
			');
	}
	
	public static function Viewdate($date) {
		$dt = explode(" ", $date);
		$idate = explode("-", $dt[0]);
		$newdate = $idate[2].'/'.$idate[1].'/'.$idate[0];
		if($dt[1]!="") $newdate .= ', '.$dt[1];
		
		return $newdate;
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
    
    public static function Translit($string) {
    	$string = (string) $string;
    	$rus = array('а','б','в','г','д','е','ё','ж',  'з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ',   'ъ','ь','ы','э','ю','я');
    	$lat = array('a','b','v','g','d','e','yo','zh','z','i','i','k','l','m','n','o','p','r','s','t','u','f','h','tc','ch','sh','sch','','','i','e','yu','ya');
    	
    	$string = strip_tags($string);
    	$string = str_replace(array("\n", "\r"), " ", $string);
    	$string = preg_replace("/\s+/", ' ', $string);
    	$string = trim($string);
    	$string = mb_strtolower($string, 'UTF-8');
    	$string = str_replace($rus, $lat, $string);
    	//$string = strtr($string, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    	$string = preg_replace("/[^0-9a-z-_ ]/i", "", $string);
    	$string = str_replace(" ", "_", $string);

    	return $string;
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