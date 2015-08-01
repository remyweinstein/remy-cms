<?php

class item_Controller extends Base_Controller{
    public $data_item;
    public $recomended;
    public $variants;
    
    public function __construct() {	
        parent::__construct();
        
        $this->model = new item_Model(Engine::$curUrlName);
            $this->content = $this->model->content;
            $this->title = $this->model->title;
            Engine::$curIdPage = $this->model->id;
            Engine::$curTemplate = $this->model->template=="" ? Engine::$curTemplate : $this->model->template;
        $this->data_item = $this->model->result;
        $this->recomended = $this->model->RecomendedItems(7);
        $this->variants = $this->model->getVariants($this->model->id);
        
        $this->getView('item');
	}
    
    
}
