<?php

class catalogs_Model {
    
    public function __construct() {
        
    }
    
    
	public function printProps($category) {
		$content = '';
                if($category>0) {
                    $props = dBShop::getCatProps($category);
                    for($y=0;$y<count($props);$y++) {
                        $name_prop = dBShop::getPropName($props[$y]);
                        $content .= '<tr id="prop'.$props[$y].'"><td>'.$name_prop.'&nbsp;<a href="#" onClick="UnlinkPropFromCat('.$props[$y].','.$category.'); return false;" alt="Отвязать характеристику" title="Отвязать характеристику"><i class="glyphicon glyphicon-trash"></i></a></td></tr>
                        ';
                    }
                }
		return $content;
	}
    
	public function printParentCats($parent = 0, $level = 0) {
		$content = '';
		$tire = '';
	
		for($i=0;$i<$level;$i++) {
                    $tire .= '-';
                }
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