<?php
class catalog_Controller extends Base_Controller {
    
    public function __construct() {	
        parent::__construct();
        
	$url_page = Engine::$curUrlName;
        $model = new catalog_Model($url_page);
            $this->content = $model->content;
            $this->title = $model->title;
            Engine::$curIdPage = $model->id;
            Engine::$curTemplate = $model->template=="" ? Engine::$curTemplate : $model->template;

	}
    
    
    
    
    
    
    
    
    
    
    
    
}
