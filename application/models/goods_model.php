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

	public function printSkus($category, $id_tov) {
            
        }
        
	public function printPropsForGoods($category, $id_tov) {
                $empty_cat = ($category==0)?'(Характеристики можно добавить после сохранения)':'';
		$content = '                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Характеристики товара:&nbsp;'.$empty_cat.'</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                if($category>0) {
                    $props = dBShop::getCatProps($category);
                    if($id_tov>0) {
                        $current_props = dBShop::getItemProps($id_tov);
                    }
                    for($y=0;$y<count($props);$y++) {
                        $name_prop = dBShop::getPropName($props[$y]);
                        $values = dBShop::getPropValues($props[$y]);
                        $content .= '<tr><td>'.$name_prop.'</td><td>
                        <select name="prop['.$props[$y].']" id="prop_'.$props[$y].'" onChange="if($(\'#prop_'.$props[$y].' :selected\').val() == \'addvid\'){AddNewPropValue(\''.$props[$y].'\');}">
                        ';
                        for($i=0;$i<count($values);$i++) {
                            $content .= '<option value="'.$values[$i]['id'].'"';
                            if($current_props[$props[$y]] == $values[$i]['id']) {
                                $content .= ' selected';
                            }
                            $content .= '>'.$values[$i]['name'].'</option>
                            ';
                        }
                        $content .= '<option value="addvid">--Добавить--</option>
                            </select>
                        </td>
                        </tr>
                        ';
                    }
                }
                $content .= '                    </tbody>
                  </table>
                  ';
		return $content;
	}
	
	public function printCatsForGoods($category, $parent = 0, $level = 0) {
                $disabled = ($category > 0)?' disabled':'';
		$content = '<select name="edit_category" id="edit_category" '.$disabled.'>';
		$tire = '';
	
		for($i=0;$i<$level;$i++) $tire .= '-';
		$result = dBShop::getAllCatsForTree($parent);
		for($i=0;$i<count($result);$i++) {
			$content .= '<option value="'.$result[$i]['id'].'"';
                        if($category == $result[$i]['id']) {
                            $content .= ' selected';
                        }
                        $content .= '> '.$tire.' '.$result[$i]['title'].'</option>
			';
			if($result[$i]['is_parent'] == 1) $content .= $this->printCats($result[$i]['id'], $level + 1);
		}
                $content .= '</select>
                        ';
		return $content;
	}
	
}