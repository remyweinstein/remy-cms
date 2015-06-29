<?php

class page_controller extends Base_Controller{	
	public $newItems;
        public $recomendedItems;
                
	public function __construct() {
            parent::__construct();
                
            $url_page = Engine::$curUrlName;
            $model = new page_Model($url_page);
            $this->content = $model->content;
            $this->title = $model->title;
            $this->breadcrumbs = Engine::BreadCrumbs(Engine::$curUrlName, $this->title);
            Engine::$curIdPage = $model->id;
            Engine::$curTemplate = $model->template=="" ? Engine::$curTemplate : $model->template;
            
            if(Engine::$curUrlName=="index"){
                $this->newItems = $model->NewItems(2);
                $this->recomendedItems = $model->RecomendedItems(3);
                $this->getView('index');
            }
	}
}