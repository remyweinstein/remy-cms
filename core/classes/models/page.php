<?php

class Page {
	public $content = '';
	public $title;
	
	
	public function __construct() {
		
		$url_page = Engine::$curUrlName;
		$result = false;
		
		$result = dB::getContentPage($url_page);
		
		if(!$result) {
			$result['template'] = 'none';
			if (file_exists(PAGE_DIR.$url_page.'.php') && !is_dir(PAGE_DIR.$url_page.'.php')) {
				$result['content'] = file_get_contents(PAGE_DIR.$url_page.'.php');
			} else {
				$result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
			}
		}
		
		$this->content = $result['content'];
		$this->title = $result['title'];
		Engine::$curIdPage = $result['id'];
		Engine::$curTemplate = $result['template']=="" ? Engine::$curTemplate : $result['template'];
		
	}
	
	
}