<?php
class goods_Controller extends Base_Controller {
	
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
			$data['id'] = $_POST['edit_item'];
			$data['url'] = $_POST['edit_url'];
			$data['category'] = $_POST['edit_category'];
			$data['title'] = $_POST['edit_title'];
			$data['content'] = $_POST['edit_content'];
			$data['country'] = $_POST['edit_country'];
			$data['active'] = (isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) ? 1 : 0;
			$data['new'] = (isset($_POST['edit_new']) && $_POST['edit_new'] == 1) ? 1 : 0;
			$data['favorite'] = (isset($_POST['edit_favorite']) && $_POST['edit_favorite'] == 1) ? 1 : 0;
                        
                        $variants['sku'] = $_POST['variants_sku'];
                        $variants['name'] = $_POST['variants_name'];
                        $variants['price'] = $_POST['variants_price'];
                        $variants['old_price'] = $_POST['variants_price_old'];
                        $variants['weight'] = $_POST['variants_weight'];
                        $variants['quantity'] = $_POST['variants_quantity'];
                        $variants['pic_url'] = $_POST['variants_pic_url'];

                        $edit_variants['id'] = $_POST['edit_variants_id'];
                        $edit_variants['id_item'] = $_POST['edit_variants_id_item'];
                        $edit_variants['sku'] = $_POST['edit_variants_sku'];
                        $edit_variants['name'] = $_POST['edit_variants_name'];
                        $edit_variants['price'] = $_POST['edit_variants_price'];
                        $edit_variants['old_price'] = $_POST['edit_variants_price_old'];
                        $edit_variants['weight'] = $_POST['edit_variants_weight'];
                        $edit_variants['quantity'] = $_POST['edit_variants_quantity'];
                        $edit_variants['pic_url'] = $_POST['edit_variants_pic_url'];
                        
			if($_POST['edit_item'] > 0) {         // Редактируем категорию
                            dBShop::updateItem($data);
                            dBShop::updateVariant($edit_variants);
                            if($variants['price'][0]!="") {
                                dBShop::newVariant($variants, $_POST['edit_item']);
                            }
			} else {                              // Создаем новую категорию
                            $id_item = dBShop::newItem($data);
                            dBShop::newVariant($variants, $id_item);
			}
		}
		
		if(isset($_GET['delete_item'])) {
			$delete = intval($_GET['delete_item']);
			dBShop::deleteItem($delete);
		}

		if(isset($_GET['delete_variant'])) {
			$delete = intval($_GET['delete_variant']);
			dBShop::deleteVariant($delete);
		}

		$this->getView(Engine::$curUrlName);
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