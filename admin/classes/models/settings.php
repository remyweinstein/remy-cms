<?php
class Settings extends Admin {
	
	public function __construct() {
		parent::__construct();
		
		if(isset($_POST['edit_settings']) && $_POST['edit_settings'] == "edit") {
			unset($_POST['edit_settings']);
			if(isset($_POST['check_registration'])) {
				//echo "POST[disable_registration] = ".$_POST['disable_registration'];
				$_POST['disable_registration'] = isset($_POST['disable_registration']) ? 1 : 0;
				unset($_POST['check_registration']);
			}
			if(isset($_POST['check_view_admin_panel'])) {
				$_POST['view_admin_panel'] = isset($_POST['view_admin_panel']) ? 1 : 0;
				unset($_POST['check_view_admin_panel']);
			}			
			foreach ($_POST as $key => $value) {
				dB::updateSettings($key, $value);
			}
		}
	}
	
	public function getOptionsTemplates() {
		$return = '<select name="edit_template" id="edit_template">
				';
		$result = dB::getNamesTemplates();
		for($i=0;$i<count($result);$i++) {
			$return .= '<option value="'.$result[$i]['name'].'">'.$result[$i]['name'].'</option>
					';
		}
		
		return $return.'</select>';
	}
	
	public function arrSettings() {
		$arr_settings = array();
		
		$admin_settings = dB::getSettings();
		for($i=0; $i<count($admin_settings); $i++) {
			$arr_settings[$admin_settings[$i]['category']][$admin_settings[$i]['name']][0] = $admin_settings[$i]['title'];
			$arr_settings[$admin_settings[$i]['category']][$admin_settings[$i]['name']][1] = $admin_settings[$i]['name'];
			$arr_settings[$admin_settings[$i]['category']][$admin_settings[$i]['name']][2] = $admin_settings[$i]['value'];
			$arr_settings[$admin_settings[$i]['category']][$admin_settings[$i]['name']][3] = $admin_settings[$i]['lenght'];
		}
		
		return $arr_settings;
	}
	
	
}