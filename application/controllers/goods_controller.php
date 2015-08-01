<?php
class goods_Controller extends Base_Controller {
        public $category;
	public $h2_category;
        public $edit_items;
        public $add_link;
        public $temporary_url;
        public $temp_favorite;
        public $temp_new;
        public $temp_view_menu;
        public $id_tov;
        
	public function __construct() {
		parent::__construct();
                
                $this->model = new Goods_Model;
				
		if(isset($_GET['delete_image']) && $_GET['delete_image'] > 0 && $_GET['edit_item'] > 0) {
			dBShop::deletePicture($_GET['edit_item']);
		}
		
		if(isset($_POST['edit_content'])) { // Сохранение изменений

                        if($_POST['edit_variants_price'][0]!="") {
                            $item_price = $_POST['edit_variants_price'][0];
                            $item_old_price = $_POST['edit_variants_price_old'][0];
                            $item_weight = $_POST['edit_variants_weight'][0];
                        } else {
                            $item_price = $_POST['variants_price'][0];
                            $item_old_price = $_POST['variants_price_old'][0];
                            $item_weight = $_POST['variants_weight'][0];
                        }
			if(isset($_FILES['edit_pic_url'])) {
				$data['pic_url'] = Engine::UploadFile($_FILES['edit_pic_url']);
			} else {
				$data['pic_url'] = $_POST['edit_pic_url'];
			}
                        
                        $edit_variants_skus = '';
                        $variants_skus = '';
                        $edit_props = '';
                        
                        foreach($_POST['prop'] as $k=>$v) {
                            $edit_props .= $k.'_'.$v.' ';
                        }
                        $edit_props = mb_substr($edit_props, 0, -1);
                        
			$data['id'] = $_POST['edit_item'];
			$data['url'] = $_POST['edit_url'];
			$data['category'] = $_POST['edit_category'];
			$data['title'] = $_POST['edit_title'];
			$data['price'] = $item_price;
			$data['old_price'] = $item_old_price;
			$data['weight'] = $item_weight;
			$data['annotation'] = $_POST['edit_annotation'];
			$data['description'] = $_POST['edit_content'];
			$data['props'] = $edit_props;
			$data['active'] = (isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) ? 1 : 0;
			$data['new'] = (isset($_POST['edit_new']) && $_POST['edit_new'] == 1) ? 1 : 0;
			$data['favorite'] = (isset($_POST['edit_favorite']) && $_POST['edit_favorite'] == 1) ? 1 : 0;
                        
                        $edit_variants['id'] = $_POST['edit_variants_id'];
                        $edit_variants['id_item'] = $_POST['edit_variants_id_item'];
                        $edit_variants['skus'] = $edit_variants_skus;
                        $edit_variants['articul'] = $_POST['edit_variants_articul'];
                        $edit_variants['price'] = $_POST['edit_variants_price'];
                        $edit_variants['old_price'] = $_POST['edit_variants_price_old'];
                        $edit_variants['weight'] = $_POST['edit_variants_weight'];
                        $edit_variants['quantity'] = $_POST['edit_variants_quantity'];
                        $edit_variants['pic_url'] = $_POST['edit_variants_pic_url'];
                        
                        $variants['skus'] = $variants_skus;
                        $variants['articul'] = $_POST['variants_articul'];
                        $variants['price'] = $_POST['variants_price'];
                        $variants['old_price'] = $_POST['variants_price_old'];
                        $variants['weight'] = $_POST['variants_weight'];
                        $variants['quantity'] = $_POST['variants_quantity'];
                        $variants['pic_url'] = $_POST['variants_pic_url'];
                        
			if($_POST['edit_item'] > 0) {         // Редактируем товар
                            dBShop::updateItem($data);
                            dBShop::updateVariant($edit_variants);
                            if($variants['price'][0]!="") {
                                dBShop::newVariant($variants, $_POST['edit_item']);
                            }
			} else {                              // Создаем новый товар
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

                if(isset($_GET['edit_item'])) {
                    if($_GET['edit_item'] > 0) { // Редактирование товара
                        $this->edit_items = dBShop::getItemById($_GET['edit_item']);
                        $this->category = $this->edit_items['id_cat'];
                        $this->id_tov = $_GET['edit_item'];
                        if($this->edit_items['active'] == 1) {
                            $this->temp_view_menu = ' checked';
                        } else {
                            $this->temp_view_menu = '';
                        }
        		if($this->edit_items['new'] == 1) {
                            $this->temp_new = ' checked';
                        } else {
                            $this->temp_new = '';
                        }
        		if($this->edit_items['favorite'] == 1) {
                            $this->temp_favorite = ' checked';
                        } else {
                            $this->temp_favorite = '';
                        }
        		if($this->edit_items['id'] == 1) $this->temporary_url = Engine::$settings['main_host'];
                		else $this->temporary_url = Engine::$settings['main_host'].'item/'.$this->edit_items['url'].'/';
                        
                        $view = 'goods_edit';
                        
                    } else { // Создаем новый товар
                        $this->category = $_GET['get_cat'];
                        $this->id_tov = 0;
                	$this->add_link = ($_GET['get_cat']>0) ? '?category_id='.$_GET['get_cat'] : '';
                        
                        $view = 'goods_new';
                    }
                } else {
                    if(!isset($_GET['category_id'])) {
                        $this->category = 0;
                        $this->h2_category = '- Все категории';
                    } else {
                        $this->category = $_GET['category_id'];
                        $this->h2_category = '- '.dBShop::getTitleCategory($this->category);
                    }
                    $view = 'goods';
                }
                
		$this->getView($view);
	}
	

	
}