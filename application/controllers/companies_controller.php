<?php
class companies_Controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->getView(Engine::$curUrlName);
    }

}