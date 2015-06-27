<?php

class Page_Model {
    public $content;
    public $title;
    public $template;
    public $id;
    
    public function __construct($url_page) {
        
        $result = dB::getContentPage($url_page);
        if(!$result) {
            $result['template'] = 'none';
            if (file_exists(PAGE_DIR.$url_page.'.php') && !is_dir(PAGE_DIR.$url_page.'.php')) {
                $result['content'] = file_get_contents(PAGE_DIR.$url_page.'.php');
                $result['title'] = Engine::$settings['main_name'];
            } else {
                $result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
                $result['title'] = 'Страница не найдена';
            }
        }
        $this->content = $result['content'];
        $this->title = $result['title'];
        $this->id = $result['id'];
        $this->template = $result['template'];
    }

	
	
}