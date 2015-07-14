<?php
class goods_Controller extends Base_Controller {
	public $country_title;
        public $category;
	public $h2_category;
        public $edit_items;
        public $add_link;
        public $temporary_url;
        public $temp_favorite;
        public $temp_new;
        public $temp_view_menu;
        
	public function __construct() {
		parent::__construct();
		
		$this->country_title = dBShop::getAllCountries();
		
		if(isset($_GET['delete_image']) && $_GET['delete_image'] > 0 && $_GET['edit_item'] > 0) {
			dBShop::deletePicture($_GET['edit_item']);
		}
		
		if(isset($_POST['edit_content'])) { // Сохранение изменений

                        if($_POST['edit_variants_price'][0]!="") {
                            $item_price = $_POST['edit_variants_price'][0];
                            $item_old_price = $_POST['edit_variants_price_old'][0];
                        } else {
                            $item_price = $_POST['variants_price'][0];
                            $item_old_price = $_POST['variants_price_old'][0];
                        }
			if(isset($_FILES['edit_pic_url'])) {
				$data['pic_url'] = Engine::UploadFile($_FILES['edit_pic_url']);
			} else {
				$data['pic_url'] = $_POST['edit_pic_url'];
			}
			$data['id'] = $_POST['edit_item'];
			$data['url'] = $_POST['edit_url'];
			$data['category'] = $_POST['edit_category'];
			$data['title'] = $_POST['edit_title'];
			$data['price'] = $item_price;
			$data['old_price'] = $item_old_price;
			$data['annotation'] = $_POST['edit_annotation'];
			$data['content'] = $_POST['edit_content'];
			$data['country'] = $_POST['edit_country'];
			$data['active'] = (isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) ? 1 : 0;
			$data['new'] = (isset($_POST['edit_new']) && $_POST['edit_new'] == 1) ? 1 : 0;
			$data['favorite'] = (isset($_POST['edit_favorite']) && $_POST['edit_favorite'] == 1) ? 1 : 0;
                        
                        $edit_variants['id'] = $_POST['edit_variants_id'];
                        $edit_variants['id_item'] = $_POST['edit_variants_id_item'];
                        $edit_variants['sku'] = $_POST['edit_variants_sku'];
                        $edit_variants['name'] = $_POST['edit_variants_name'];
                        $edit_variants['price'] = $_POST['edit_variants_price'];
                        $edit_variants['old_price'] = $_POST['edit_variants_price_old'];
                        $edit_variants['weight'] = $_POST['edit_variants_weight'];
                        $edit_variants['quantity'] = $_POST['edit_variants_quantity'];
                        $edit_variants['pic_url'] = $_POST['edit_variants_pic_url'];
                        
                        $variants['sku'] = $_POST['variants_sku'];
                        $variants['name'] = $_POST['variants_name'];
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
                    $list_countries = $this->country_title;
                    $view = 'goods';
                }
                
		$this->getView($view);
	}

        public function printListGoods($category) {
            $content='';
            $arr_items = dBShop::getAllItems($category);
            for($i=0;$i<count($arr_items);$i++) {
                $content .= '<tr>
                <td class="center"><img src="'.Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$arr_items[$i]['pic_url'].'" width="120" />
                <input type="hidden" name="pic_url[]" value="'.$arr_items[$i]['pic_url'].'" />
        	</td>
                <td class="center">'.$arr_items[$i]['title'].'
        	<input type="hidden" name="title[]" value="'.$arr_items[$i]['title'].'" />
                ';
                $title_category = dBShop::getTitleCategory($arr_items[$i]['category']);
                $content .= '<br>Категория: <a href="/admin/goods/?category_id='.$arr_items[$i]['category'].'">'.$title_category['title'].'</a>
                <br>Производитель: '.$list_countries[($arr_items[$i]['country']-1)]['title'].'
                </td>
                <td class="center">'.$arr_items[$i]['price'].'
        	<input type="hidden" name="price[]" value="'.$arr_items[$i]['price'].'" />
        	</td>
                <td class="center">
                ';
                $content .= ($arr_items[$i]['quantity']==0) ? 'Под заказ' : 'В наличии';
                $content .= '<input type="hidden" name="quantity[]" value="'.$arr_items[$i]['quantity'].'" />
                </td>
                <td class="center">
        	<a href="/admin/goods/?delete_item='.$arr_items[$i]['id'].'" alt="Удалить" title="Удалить"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;
        	<a href="/admin/goods/?edit_item='.$arr_items[$i]['id'].'" alt="Редактировать" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;';
        	$content .= ($arr_items[$i]['quantity'] == 0) ? '<a href="#" alt="Установить В наличии" title="Установить В наличии"><i class="glyphicon glyphicon-inbox"></i></a>&nbsp;&nbsp;' : '<a href="#" alt="Установить Под заказ" title="Установить Под заказ"><i class="glyphicon glyphicon-time"></i></a>&nbsp;&nbsp;';
                $content .= ($arr_items[$i]['active'] == 0) ? '<a href="#" alt="Показывать на сайте" title="Показывать на сайте"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;' : '<a href="#" alt="Не показывать на сайте" title="Не показывать на сайте"><i class="glyphicon glyphicon-eye-close"></i></a>&nbsp;&nbsp;';
                $content .= '</td>
                </tr>
                ';
            }
            return $content;
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