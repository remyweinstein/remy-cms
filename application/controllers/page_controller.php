<?php

class page_controller extends Base_Controller{	
	public $newItems;
        public $recomendedItems;
                
	public function __construct() {
            parent::__construct();
                
            $this->model = new page_Model(Engine::$curUrlName);
            $this->content = $this->model->content;
            $this->title = $this->model->title;
            $this->breadcrumbs = Engine::BreadCrumbs(Engine::$curUrlName, $this->title);
            Engine::$curIdPage = $this->model->id;
            Engine::$curTemplate = $this->model->template=="" ? Engine::$curTemplate : $this->model->template;
            
            if(Engine::$curUrlName=="index"){
                $this->newItems = $this->model->NewItems(2);
                $this->recomendedItems = $this->model->RecomendedItems(3);
                $this->getView('index');
            }
	}
}