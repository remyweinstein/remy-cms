<?php
class catalog_Controller extends Base_Controller {
    public $data_items;
    
    public function __construct() {	
        parent::__construct();
        
        $this->model = new catalog_Model(Engine::$curUrlName);
            $this->content = $this->model->content;
            $this->title = $this->model->title;
            Engine::$curIdPage = $this->model->id;
            Engine::$curTemplate = $this->model->template=="" ? Engine::$curTemplate : $this->model->template;
        
            $this->data_items = dBShop::getAllItems($this->model->id);
        
        $this->getView('catalog');

	}
    
    
    
    
    
    
    
    
    
    
    
    
}
