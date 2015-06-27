<?php

class Base_Controller {
    public $content = "";
    public $title = "";
    public $leftmenu = "";
    public $breadcrumbs = "";

    function __construct() {
        $this->leftmenu = Engine::getLayout('leftmenu', Base_Model::getMenuCatalog());
    }



    
}
