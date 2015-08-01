<?php

class Goods_Model {
    
    public function __construct() {
        
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
        
	public function printProps($category) {
		$content = '';
                $props = dBShop::getCatProps($category);
                for($y=0;$y<count($props);$y++) {
                    $name_prop = dBShop::getPropName($props[$y]['pid']);
                    $values = dBShop::getPropValues($props[$y]['pid']);
                    $content .= '<tr><td>'.$name_prop.'</td><td>
                    <select name="prop[\''.$props[$y]['pid'].'\']">
                    ';
                    for($i=0;$i<count($values);$i++) {
			$content .= '<option value="'.$values[$i]['id'].'">'.$values[$i]['name'].'</option>
			';
                        }
                    $content .= '</select>
                        </td>
                    </tr>
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