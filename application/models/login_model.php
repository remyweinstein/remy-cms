<?php
class Login {
	public $content = '';
	public $title;
	public $id;

	public function __construct() {

		$this->content = "";
		$this->title = "Авторизация";
		Engine::$curIdPage = "";
		
		Engine::$curTemplate = "auth";

	}
	
}