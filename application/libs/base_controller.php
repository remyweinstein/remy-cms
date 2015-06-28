<?php

class Base_Controller {
    public $content = "";
    public $title = "";
    public $leftmenu = "";
    public $breadcrumbs = "";

    function __construct() {
        if(Engine::$curAdmin) {
            if(User::$globalRole < 2) {
                Engine::DirectLink("/login/");
            } else {
                Engine::$curTemplate = "admin";
            }
        } else {
            $this->leftmenu = Engine::getLayout('leftmenu', Base_Model::getMenuCatalog());
        }
    }

    public function getView($views) {
        if(Engine::$curAdmin){
            $path=ADMIN_VIEWS;
        } else {
            $path=APP_VIEWS;
        }
        ob_start();
        include $path.$views.'_view.php';
        $this->content = ob_get_contents();
        ob_end_clean();
        Engine::$curIdPage = "";       
    }

    
}
