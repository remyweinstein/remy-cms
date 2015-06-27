<?php
class catalog_Model {
    public $content;
    public $title;
    public $template;
    public $id;
	
	public function __construct($url_page) {
            $result = dBShop::getContentCatalog($url_page);
            $this->content = $result['content'];
            $this->title = $result['title'];
            $this->id = $result['id'];
            $this->template = $result['template'];
            if(!$result) {
                $result['template'] = 'none';
                $result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
            }
	}
	
	public function listCategory($parent=0) {
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

        public function listProducts() {

        }

	
}