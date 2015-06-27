<?php
class Admin {
    public $content = '';
    public $title;
    public $contentPage = '';
	
    public function __construct() {
        if(User::$globalRole < 2) {
            Engine::DirectLink("/login/");
        } else {
            Engine::$curTemplate = "admin";
        }
    }
	
    public function getView($views) {
        ob_start();
        include ADMIN_VIEWS.$views.'_view.php';
        $this->content = ob_get_contents();
        ob_end_clean();
        Engine::$curIdPage = "";       
    }
	
	
	
	
}