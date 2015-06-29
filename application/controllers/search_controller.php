<?php

class search_Controller extends Base_Controller{
    public $data_item;
    
    public function __construct() {	
        parent::__construct();
        
	$url_page = Engine::$curUrlName;
        $model = new search_Model();
/*
        $this->content = $model->content;
            $this->title = $model->title;
            Engine::$curIdPage = $model->id;
            Engine::$curTemplate = $model->template=="" ? Engine::$curTemplate : $model->template;
        $this->data_item = $model->result;
*/
        $this->getView('search');
	}
    
    
    
}