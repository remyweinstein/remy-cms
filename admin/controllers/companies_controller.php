<?php
class companies_Controller extends Admin {

    public function __construct() {
        parent::__construct();
        
        $this->getView(Engine::$curUrlName);
    }

}