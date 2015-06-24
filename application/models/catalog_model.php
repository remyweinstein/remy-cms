<?php
class Catalog {
	public $content = '';
	public $title;
	public $id;
	
	public function __construct() {
	
		$url_page = Engine::$curUrlName;
	
		$result = dBShop::getContentCatalog($url_page);
	
		if(!$result) {
			$result['template'] = 'none';
			$result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
		}
		
		$this->content = $result['content'];
		$this->title = $result['title'];
		Engine::$curIdPage = $result['id'];
		Engine::$curTemplate = $result['template']=="" ? Engine::$curTemplate : $result['template']; 
	
	}
	
	public static function listCategory($parent=0) {
		$view = '<ul>';
		if (Engine::$curModule == "catalog") {
                    $parent = Engine::$curIdPage;
                }
                $result = dBShop::getListCategory($parent);
		for($i=0;$i<count($result);$i++) {
			$view .= '<li><a href="/catalog/'.$result[$i]['url'].'/">'.$result[$i]['title'].'</a></li>
					'; 
		}
		$view .= '</ul>
				';
		
		return $view;
	}
	
	
}