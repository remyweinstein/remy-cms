<?php
class Registration {
	public $content = '';
	public $title;
	public $id;

	public function __construct() {

		$this->content = "";
		$this->title = "Регистрация";
		Engine::$curIdPage = "";

		Engine::$curTemplate = "auth";
		
	}
	
	
}