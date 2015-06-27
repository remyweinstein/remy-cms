<?php
class modules_Controller extends Admin {
	
	public function __construct() {
		parent::__construct();
                $this->getView(Engine::$curUrlName);
	}
	
}