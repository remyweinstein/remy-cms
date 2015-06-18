<?php
class Pages extends Admin {
	
	public function __construct() {
		parent::__construct();
		
		if(isset($_GET['delete_page'])) { // Удаление страницы
			$delete_page = intval($_GET['delete_page']);
			if($delete_page>1) {
				// Удаляем дочерние страницы
				dB::deleteParentPages($delete_page);
				// Проверяем есть ли дочерние страницы у родителя
				$parent = dB::findParentPage($delete_page);
				dB::deletePage($delete_page);
				// Меняем статус is_parent
				$count = dB::countParentPage($parent);
				if($count<1) {
					dB::uncheckIsParentPage($parent);
				}
			}
		}
		
		if(isset($_POST['edit_content'])) {
			if(isset($_POST['edit_view_menu']) && $_POST['edit_view_menu'] == 1) {
				$data['view_menu'] = 1;
			} else {
				$data['view_menu'] = 0;
			}			
			if(isset($_GET['edit_page']) && $_GET['edit_page'] > 0) { // Редактируем страницу
				$id = $_GET['edit_page'];
				$data['id'] = $id;
				$data['title'] = $_POST['edit_title'];
				$data['url'] = ($id==1) ? "index" : $_POST['edit_url'];
				$data['content'] = $_POST['edit_content'];
				$data['parent'] = $_POST['edit_parent'];
				$data['template'] = $_POST['edit_template'];
                                if($data['url']=="") $data['url'] = Engine::Translit($data['title']);
                                
				$parent = dB::findParentPage($id);
				
				dB::updatePage($data);
				
				if($parent != $_POST['edit_parent']) {
					dB::checkIsParentPage($_POST['edit_parent']);
					$count_parent_pages = dB::countParentPage($parent);
					if($count_parent_pages<1) dB::uncheckIsParentPage($parent);
				}
			} else { // Добавляем новую страницу
				$data['title'] = $_POST['edit_title'];
				$data['url'] = $_POST['edit_url'];
				$data['content'] = $_POST['edit_content'];
				$data['parent'] = $_POST['edit_parent'];
				$data['template'] = $_POST['edit_template'];
                                if($data['url']=="") $data['url'] = Engine::Translit($data['title']);
					
				dB::newPage($data);
				if($_POST['edit_parent']>0) dB::checkIsParentPage($_POST['edit_parent']);
			}
		}
		
		
	}
	
	public function getNamesTemplates() {
		$list = '<select name="edit_template" id="edit_template">
		';

		$result = dB::getNamesTemplates();
		for($i=0;$i<count($result);$i++) {
			$list .= '<option value="'.$result[$i]['name'].'">'.$result[$i]['name'].'</option>
			';
		}
		$list .= '</select>
		';
		return $list;
	}
	
	public function printParentPages($parent = 0, $level = 0) {
		$content = '';
		$tire = '';
		
		for($i=0;$i<$level;$i++) $tire .= '-';
		$result = dB::getAllPagesForTree($parent);
		for($i=0;$i<count($result);$i++) {	
			$content .= '<option value="'.$result[$i]['id'].'"> '.$tire.' '.$result[$i]['title'].'</option>
			';
			if($result[$i]['is_parent'] == 1) $content .= $this->printParentPages($result[$i]['id'], $level + 1);
		}
		
		return $content;
	}
	
	
	public function printTreePages($parent = 0, $sub = false) {
		$content = $sub ? '<ul style="display:none;" id="subpages'.$parent.'">' : '<ul>';
		
		$result = dB::getAllPagesForTree($parent);
		for($i=0;$i<count($result);$i++) {	
			$content .= '<li class="admin_page">
 			<a href="/admin/pages/?delete_page='.$result[$i]['id'].'" alt="Удалить страницу" title="Удалить страницу"><i class="glyphicon glyphicon-trash"></i></a>
 			<a href="/admin/pages/?add_page='.$result[$i]['id'].'" alt="Добавить дочернюю страницу" title="Добавить дочернюю страницу"><i class="glyphicon glyphicon-plus"></i></a>
			<a href="/admin/pages/?edit_page='.$result[$i]['id'].'" alt="Редактировать страницу" title="Редактировать страницу"><i class="glyphicon glyphicon-edit"></i></a>';
			if($result[$i]['is_parent'] == 1) {
				$content .= '<a href="#" onClick="openSubPage('.$result[$i]['id'].');" alt="Раскрыть" title="Раскрыть"><i class="glyphicon glyphicon-folder-close" id="pages'.$result[$i]['id'].'"></i>';
			} else {
				$content .= '<i class="glyphicon glyphicon-folder-close" style="color:#F0F0F0;"></i>';
			}
                        $content .= '<span>'.$result[$i]['title'].'</span>';
			if($result[$i]['is_parent'] == 1) {
				$content .= '</a>'.
                                        $this->printTreePages($result[$i]['id'], true);
			}
			$content .= '</li>
  			';
		}
		$content .= '</ul>
		';
		
		return $content;
	}
	
	
}