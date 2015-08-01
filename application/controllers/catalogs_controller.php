<?php
class catalogs_Controller extends Base_Controller {
    public $edit_categorys;
    public $temp_view_menu;
    public $temporary_url;
    public $category;

        public function __construct() {
		parent::__construct();
		
                $this->model = new catalogs_Model();
                
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
                        $this->category = $_GET['edit_category'];
                        if($this->edit_categorys['active'] == 1) $this->temp_view_menu = ' checked';
                            else $this->temp_view_menu = '';
                        if($this->edit_categorys['id'] == 1) $this->temporary_url = Engine::$settings['main_host'];
                            else $this->temporary_url = Engine::$settings['main_host'].'catalog/'.$this->edit_categorys['url'].'/';

                        $view = 'catalogs_edit';
                    }
                    if(($_GET['add_category'] > 0 || $_GET['add_category'] == 0) && $_GET['edit_category'] == 0) { // Создаем новую страницу
                        $this->category = 0;
                        $view = 'catalogs_new';
                    }
                }
		$this->getView($view);
	}
	

	
	
}