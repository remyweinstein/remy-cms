<?php

class ajax_controller extends Base_Controller{
                
	public function __construct() {
            parent::__construct();
            
            Engine::$curTemplate = 'none';
            $this->model = new Ajax_Model();

            /*
            echo Engine::$user->Id.'<br>'.
            Engine::$user->Login.'<br>'.
            Engine::$user->Name.'<br>'.
            Engine::$user->Role.'<br>'.
            Engine::$user->Status.'<br>'.
            Engine::$user->Email.'<br>'.
            Engine::$user->Picture.'<br>';
            */
            
            
            
	}
        
        
        
        
        
}