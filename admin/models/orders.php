<?php
class Orders extends Admin {
	
	public function __construct() {
		parent::__construct();
	
		if(isset($_POST['edit_order']) && $_POST['edit_order']!="") {
			$data['login'] = $_POST['edit_login'];
			$data['email'] = $_POST['edit_email'];
			$data['name'] = $_POST['edit_name'];
			$data['status'] = $_POST['edit_status'];
			$data['level'] = $_POST['edit_level'];
			$data['id'] = $_POST['edit_user_id'];
			dBShop::updateOrder($data);
		}
		
		
		
	}
	
	
	
}