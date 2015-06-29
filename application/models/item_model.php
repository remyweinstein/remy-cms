<?php

class item_Model {
    public $content;
    public $title;
    public $template;
    public $id;
    public $result;
	
	public function __construct($url_page) {
            $this->result = dBShop::getContentItem($url_page);
            $this->content = $this->result['content'];
            $this->title = $this->result['title'];
            $this->id = $this->result['id'];
            $this->template = $this->result['template'];
            if(!$this->result) {
                $this->result['template'] = 'none';
                $this->result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
            }
	}
    
    
    
    
}

