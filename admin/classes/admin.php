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
	
	
	
	
	
	
}