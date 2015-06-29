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

    public function NewItems($items){
        $content = '';
        $result = dBShop::getNewItems($items);
        for($i=0;$i<count($result);$i++) {
        $content .= '<div class="product_box"> <img src="uploads/'.$result[$i]['pic_url'].'" style="width:144px;height:216px;" alt="" class="prod_image" />
        <div class="product_details">
          <div class="prod_title">'.$result[$i]['title'].'</div>
          <p> '.$result[$i]['annotation'].' </p>
          <p class="price">Цена: <span class="price">'.$result[$i]['price'].' Р</span></p><br><br>
          <div class="button"><a href="/item/'.$result[$i]['url'].'/">Подробнее</a></div>
        </div>
        </div>
        ';
        }
        return $content;
    }
    
        public function RecomendedItems($items) {
            $content = '';
            $result = dBShop::getRecomendedItems($items);
            for($i=0;$i<count($result);$i++) {
                $content .= '<a href="/item/'.$result[$i]['url'].'/"><img src="/uploads/'.$result[$i]['pic_url'].'" alt="'.$result[$i]['title'].'" style="width:80px;height:120px;" class="sp" border="0" /></a>';
            }
            return $content;
        }
	
}