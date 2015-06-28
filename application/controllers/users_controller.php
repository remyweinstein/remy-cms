<?php
class users_Controller extends Base_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if(isset($_POST['edit_user_id']) && $_POST['edit_user_id']!="") {
			$data['login'] = $_POST['edit_login'];
			$data['email'] = $_POST['edit_email'];
			$data['name'] = $_POST['edit_name'];
			$data['status'] = $_POST['edit_status'];
			$data['level'] = $_POST['edit_level'];
			$data['id'] = $_POST['edit_user_id'];
			dB::updateUser($data);
		}
                $this->getView(Engine::$curUrlName);
	}
	
	
}