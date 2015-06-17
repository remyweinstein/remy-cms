<?php
class Goods extends Admin {
	
	public $country_title;
	
	public function __construct() {
		parent::__construct();
		
		$this->country_title = dBShop::getAllCountries();
		
		if(isset($_GET['delete_image']) && $_GET['delete_image'] > 0 && $_GET['edit_item'] > 0) {
			dBShop::deletePicture($_GET['edit_item']);
		}
		
		if(isset($_POST['edit_content'])) { // Сохранение изменений

			if(isset($_FILES['edit_pic_url'])) {
				$data['pic_url'] = Engine::UploadFile($_FILES['edit_pic_url']);
			} else {
				$data['pic_url'] = $_POST['edit_pic_url'];
			}
			$data['active'] = (isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) ? 1 : 0;
			$data['title'] = $_POST['edit_title'];
			$data['url'] = $_POST['edit_url'];
			$data['content'] = $_POST['edit_content'];
			$data['category'] = $_POST['edit_category'];
			$data['id'] = $_POST['edit_item'];
			$data['price'] = $_POST['edit_price'];
			$data['price_zakup'] = $_POST['edit_price_zakup'];
			$data['quantity'] = $_POST['edit_quantity'];
			$data['weight'] = $_POST['edit_weight'];
			$data['lenght'] = $_POST['edit_lenght'];
			$data['prop'] = $_POST['edit_prop'];
			$data['country'] = $_POST['edit_country'];
			if($_POST['edit_item'] > 0) { // Редактируем категорию
				dBShop::updateItem($data);
			} else { // Создаем новую категорию
				dBShop::newItem($data);
			}
		}
		
		if(isset($_GET['delete_item'])) {
			$delete = intval($_GET['delete_item']);
			dBShop::deleteItem($delete);
		}

		
		

	}

	
	public function printCountry() {
		$content = '';
		
		$result = dBShop::getAllCountries();
		for($i=0;$i<count($result);$i++) {
			$content .= '<option value="'.$result[$i]['id'].'">'.$result[$i]['title'].'</option>
			';
		}
		
		return $content;
		
	}
	
	public function printCats($parent = 0, $level = 0) {
		$content = '';
		$tire = '';
	
		for($i=0;$i<$level;$i++) $tire .= '-';
		$result = dBShop::getAllCatsForTree($parent);
		for($i=0;$i<count($result);$i++) {
			$content .= '<option value="'.$result[$i]['id'].'"> '.$tire.' '.$result[$i]['title'].'</option>
			';
			if($result[$i]['is_parent'] == 1) $content .= $this->printCats($result[$i]['id'], $level + 1);
		}
	
		return $content;
	}
	
}