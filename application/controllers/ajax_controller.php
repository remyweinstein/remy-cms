<?php

class ajax_controller extends Base_Controller{

	public function __construct() {
            parent::__construct();
            
            Engine::$curTemplate = 'none';
            $this->model = new Ajax_Model();
            $func = Engine::$curUrlName;

            if(Engine::$user->Role > 4) {
                if(method_exists($this->model, $func)){
                    $data = $_POST['data'];
                    echo $this->model->$func($data);
                }
            } else {
                echo 'Доступ запрещен';
            }
            
            
            
	}
        
        
        
        
}