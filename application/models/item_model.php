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
        
        public function RecomendedItems($items) {
            $content = '';
            $result = dBShop::getRecomendedItems($items);
            for($i=0;$i<count($result);$i++) {
                $content .= '<a href="/item/'.$result[$i]['url'].'"><img src="/uploads/'.$result[$i]['pic_url'].'" alt="'.$result[$i]['title'].'" style="width:80px;height:120px;" class="sp" border="0" /></a>'
                        . ''; 
            }
            return $content;
        }
        
        public function getVariants($id) {
            $content = '';
            $result = dBShop::getVariantsByItem($id);
            for($i=0;$i<count($result);$i++) {
                $content .= '<a href="#">'.$result[$i]['name'].'</a>';
            }
            
            return $content;
        }
    
    
    
}

