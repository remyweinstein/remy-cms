<?php
class catalogs_Controller extends Base_Controller {
    public $edit_categorys;
    public $temp_view_menu;
    public $temporary_url;

        public function __construct() {
		parent::__construct();
		
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
                        if($data['url']=="") $data['url'] = Format::Translit($data['title']);
				
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
                
                if(!isset($_GET['edit_category']) && !isset($_GET['add_category'])) { // Список категорий
                    $view = 'catalogs';
                } else {
                    if($_GET['edit_category'] > 0 && $_GET['add_category'] == 0) { // Редактирование страницы
                        $this->edit_categorys = dBShop::getContentCatById($_GET['edit_category']);
                        if($this->edit_categorys['active'] == 1) $this->temp_view_menu = ' checked';
                            else $this->temp_view_menu = '';
                        if($this->edit_categorys['id'] == 1) $this->temporary_url = Engine::$settings['main_host'];
                            else $this->temporary_url = Engine::$settings['main_host'].'catalog/'.$this->edit_categorys['url'].'/';

                        $view = 'catalogs_edit';
                    }
                    if(($_GET['add_category'] > 0 || $_GET['add_category'] == 0) && $_GET['edit_category'] == 0) { // Создаем новую страницу
                        $view = 'catalogs_new';
                    }
                }
		$this->getView($view);
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