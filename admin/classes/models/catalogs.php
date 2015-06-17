<?php
class Catalogs extends Admin {
	
	public function __construct() {
		parent::__construct();
		
		if(isset($_POST['check'])) {
			for($i=0;$i<count($_POST['names']);$i++) {
				if($_POST['check'][$i] == 1) {
					//$_POST['images'][$i]
					//$_POST['names'][$i]
					//$_POST['prices'][$i]
					if(!dBShop::getItemByTitle($_POST['names'][$i])) {
						
						$count = (strpos($_POST['names'][$i], 'аказ') === false)?100:0;
						
						$image_name = Engine::Translit(mt_rand(111111, 999999).'_'.basename($_POST['images'][$i]));
						copy($_POST['images'][$i], $_SERVER[DOCUMENT_ROOT].'/'.Engine::$settings['directory_pictures'].'/'.$image_name);
						
						$arr_item['url'] = Engine::Translit($_POST['names'][$i]);
						$arr_item['category'] = $_GET['parsing_goods'];
						$arr_item['title'] = $_POST['names'][$i];
						$arr_item['content'] = '';
						$arr_item['pic_url'] = $image_name;
						$arr_item['price'] = $_POST['prices'][$i];
						$arr_item['price_zakup'] = $_POST['prices'][$i];
						$arr_item['quantity'] = $count;
						$arr_item['weight'] = 0;
						$arr_item['lenght'] = 0;
						$arr_item['prop'] = '';
						$arr_item['active'] = '1';
						$arr_item['country'] = '1';
						
						
						dBShop::newItem($arr_item);
					}
				}
			}
		}
		
		if(isset($_GET['delete_category'])) {
			$delete = intval($_GET['delete_category']);
			dBShop::deleteParentCats($delete);
			$parent = dBShop::findParentCat($delete);
			dBShop::deleteCat($delete);
			$count = dBShop::countParentCat($parent);			
			if($count < 1) {
				dBShop::uncheckIsParentCat($parent);
			}
		}
		
		if(isset($_POST['edit_content'])) { // Сохранение изменений
			$data['active'] = (isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) ? 1 : 0;
			$data['title'] = $_POST['edit_title'];
			$data['url'] = $_POST['edit_url'];
			$data['content'] = $_POST['edit_content'];
			$data['parent'] = $_POST['edit_parent'];
			$data['id'] = $_GET['edit_category'];
			$data['data'] = $_POST['parsing_data'];
			$data['source'] = $_POST['parsing_source'];
				
			if(isset($_GET['edit_category']) && $_GET['edit_category'] > 0) { // Редактируем категорию
				$edit_categorys = dBShop::findParentCat($_GET['edit_category']);
				dBShop::updateCat($data);
				if($parent != $_POST['edit_parent']) {
					dBShop::checkIsParentCat($_POST['edit_parent']);
					$count = dBShop::countParentCat($parent);
					if($count < 1) {
						dBShop::uncheckIsParentCat($parent);
					}
				}
			} else { // Создаем новую категорию
				dBShop::newCat($data);
				if($data['parent']>0) {
					dBShop::checkIsParentCat($data['parent']);
				}
			}
			
		}
		
	}
	
	public function GetGoods($id, $page = 1) {
		
		$data = dBShop::getContentCatById($id);
		
		if($data['parsing_source'] != "") {
			
				$arr = explode(";", $data['parsing_data']);
				$images = $arr[0];
				$names = $arr[1];
				$prices = $arr[2];
				$count_items = $arr[3];
				$data['parsing_source'] = ($count_items == "none") ? $data['parsing_source'] : $data['parsing_source'].'&'.$count_items.'='.$page;
				$parse =  parse_url($data['parsing_source']);
				$parsing_domen = $parse['host'];
				$parse['host'] = 'http://'.$parse['host'];
				$arr_win1251 = array('www.boyard.biz','furlux.ru','622224.ru','f3online.ru','malkomebel.ru','www.xn--80appu1a.xn--p1ai','www.brist.ru');
				
			$opts = array(
						'http'=>array(
								'method'=>"GET",
								'header'=>"Accept-language: ru\r\n" .
								"User-Agent: Mozilla/5.0 (X11; U; Linux i686; ru; rb:1.9.2) Firefox/3.0.6\r\n" .
								"Accept: text/html,application/xml;q=0.9,*/*;q=0.8\r\n" .
								"Accept-Charset: utf-8"
						)
			);
			$context = stream_context_create($opts);
			$content = file_get_contents($data['parsing_source'], false, $context);
			
			$content = str_replace("class='price ruble'", "class='price-ruble'" , $content);//sitiart
			$content = str_replace(" <span class='ruble'>р.</span>", "" , $content);//sitiart
			$content = str_replace("old-price", "" , $content);//tbm
			$content = str_replace('<span class="">', '<span class="price_unic">' , $content);//tbm
			$content = str_replace('<span class="currency">РУБ</span>', '' , $content);//tbm
			$content = str_replace(".html\">\n               \n            </a>", ".html\"><img src=\"\"></a>", $content);//tbm
			$content = str_replace('<div style="height:40px;">', '<div class="name_2">' , $content);//furlux
			$content = str_replace('class="price" style="text-align:left;float:left;margin-top:20px;"', 'class="price_2"' , $content);//furlux
			$content = str_replace('<img src="/upload/iblock/', '<img class="image_2" src="/upload/iblock/' , $content);//furlux
			$content = str_replace('-125x125', '' , $content);//eurotrade27
			$content = str_replace('-150x150', '' , $content);//eurotrade27
			$content = str_replace("/images/pokr/small/", "/images/pokr/large/" , $content);//f3online
			$content = str_replace("/pokr-small-", "/pokr-" , $content);//f3online			
			$content = str_replace("alt=''/ title='", "class=\"img_source\"><div class=\"name_source\">" , $content);//шинта.рф
			$content = str_replace("' vspace=5>", "</div>" , $content);//шинта.рф
			$content = str_replace("return hs.expand(this)' href='http://brist.ru/", "return hs.expand(this)' href=\"\"></a><a href=\"\"><img class=\"image_picture\" src='http://brist.ru/" , $content);//brist.ru
			$content = str_replace('meta content="/thumb/', 'img src="/thumb/', $content);//boyard.biz
			$content = str_replace('itemprop="image"', 'class="itemprop_image"', $content);//boyard.biz
			$content = str_replace('itemprop="name"', 'class="itemprop_name"', $content);//boyard.biz			
			$content = str_replace('class="currency-title active"  data-currency="RUB"', 'class="data-currency"', $content);//boyard.biz
			$content = str_replace('class="currency-title "  data-currency="RUB"', 'class="data-currency"', $content);//boyard.biz
			
			//$content = str_replace('" title="', '" title=""><span>', $content);//staron
			//$content = str_replace('"><img src="', '</span><img src="', $content);//staron
			
			//echo $content;
			//exit();
			
			$saw = new Nokogiri($content);
				$images_arr = $saw->get($images)->toArray();
				for($i=0;$i<count($images_arr);$i++) {
					$temp_host = (strpos($images_arr[$i]['src'], 'http') === false)? $parse['host'] : '';
					$arr_string[$i]['images'] = (in_array($parsing_domen, $arr_win1251)) ? $temp_host.trim($images_arr[$i]['src']) : $temp_host.utf8_decode(trim($images_arr[$i]['src']));
				}
				$names_arr = $saw->get($names)->toArray();
				for($i=0;$i<count($names_arr);$i++) {
					//mb_detect_order('UTF-8', 'ISO-8859-1');
					//$arr_string[$i]['names'] = mb_convert_encoding(trim($names_arr[$i]['#text']), 'UTF-8', 'ISO-8859-1');
					$arr_string[$i]['names'] = (in_array($parsing_domen, $arr_win1251)) ? trim($names_arr[$i]['#text']) : utf8_decode(trim($names_arr[$i]['#text']));
					
					//$arr_string[$i]['names'] = iconv('ISO-8859-1', 'UTF-8', trim($names_arr[$i]['#text']));
				}
				$prices_arr = $saw->get($prices)->toArray();
				for($i=0;$i<count($prices_arr);$i++) {
					
					$arr_string[$i]['prices'] = preg_replace('/[^0-9,.]/', '', trim($prices_arr[$i]['#text']));
				}
				$arr_string[0]['pages'] = $count_items;
				
			return $arr_string;
		
		} else return false;
	}
	
	
	
	public function printParentCats($parent = 0, $level = 0) {
		$content = '';
		$tire = '';
	
		for($i=0;$i<$level;$i++) $tire .= '-';
		$result = dBShop::getAllCatsForTree($parent);
		for($i=0;$i<count($result);$i++) {
			$content .= '<option value="'.$result[$i]['id'].'"> '.$tire.' '.$result[$i]['title'].'</option>
			';
			if($result[$i]['is_parent'] == 1) $content .= $this->printParentCats($result[$i]['id'], $level + 1);
		}
	
		return $content;
	}
	
	public function printTreeCats($parent = 0, $sub = false) {
		$content = $sub ? '<ul style="display:none;" id="subpages'.$parent.'">' : '<ul>';
	
		$result = dBShop::getAllCatsForTree($parent);
		for($i=0;$i<count($result);$i++) {
			$content .= '<li class="admin_page">
 			<a href="/admin/catalogs/?delete_category='.$result[$i]['id'].'" alt="Удалить категорию" title="Удалить категорию"><i class="glyphicon glyphicon-trash"></i></a>
 			<a href="/admin/catalogs/?add_category='.$result[$i]['id'].'" alt="Добавить дочернюю категорию" title="Добавить дочернюю категорию"><i class="glyphicon glyphicon-plus"></i></a>
 			<a href="/admin/catalogs/?edit_category='.$result[$i]['id'].'" alt="Редактировать категорию" title="Редактировать категорию"><i class="glyphicon glyphicon-edit"></i></a>
 			<a href="/admin/catalogs/?parsing_goods='.$result[$i]['id'].'" alt="Parsing Goods" title="Parsing Goods"><i class="glyphicon glyphicon-download-alt"></i></a>
 			<a href="/admin/goods/?category_id='.$result[$i]['id'].'" alt="Открыть все товары" title="Открыть все товары"><i class="glyphicon glyphicon-gift"></i></a>
 			';
			if($result[$i]['is_parent'] == 1) {
				$content .= '<a href="#" onClick="openSubPage('.$result[$i]['id'].');" alt="Раскрыть категории" title="Раскрыть категории"><i class="glyphicon glyphicon-folder-close" id="pages'.$result[$i]['id'].'"></i>  <span>'.$result[$i]['title'].'</span></a>';
			} else {
				$content .= '<i class="glyphicon glyphicon-folder-close" style="color:#F0F0F0;"></i>  <span>'.$result[$i]['title'].'</span>';
			}
			if($result[$i]['is_parent'] == 1) {
				$content .= $this->printTreeCats($result[$i]['id'], true);
			}
			$content .= '</li>
  			';
		}
		$content .= '</ul>
		';
	
		return $content;
	}
	
	
}