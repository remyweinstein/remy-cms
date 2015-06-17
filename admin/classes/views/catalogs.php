<?php

if(isset($_GET['parsing_goods'])) { // Парсинг Товаров
	
	if(isset($_GET['page'])) {
		$add_pages = $_GET['page'];
	} else {
		$add_pages = 1;
	}
	$new_goods = $contentPage->GetGoods($_GET['parsing_goods'], $add_pages);
	if($new_goods[0]['pages']!="none") {
		if(!isset($_GET['page'])) $_GET['page'] = 1;
	}
	echo '<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">
<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-list-alt"></i> Парсинг</h2>
</div>	
<div class="box-content">
';
echo ($new_goods[0]['pages']=="none") ? '' : '<div class="alert alert-info">
<a href="/admin/catalogs/?parsing_goods='.$_GET['parsing_goods'].'&page='.($_GET['page'] - 1).'" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-arrow-left"></i> Предыдущая страница</a>
&nbsp;&nbsp;<strong>Страница: '.$_GET['page'].'</strong>&nbsp;&nbsp;
<a href="/admin/catalogs/?parsing_goods='.$_GET['parsing_goods'].'&page='.($_GET['page'] + 1).'" class="btn btn-success btn-sm">Следующая страница <i class="glyphicon glyphicon-arrow-right"></i></a>
</div>
';
echo '<table class="table table-striped">
<thead>
<tr>
<th><input type="checkbox" id="select_all" checked></th>
<th>Картинка</th>
<th>Название</th>
<th>Цена</th>
</tr>
</thead>
<tbody>
	<form action="" method="POST">
			';
if($new_goods) {
	for($i=0;$i<count($new_goods);$i++){
		echo '<tr>
<td><input type="checkbox" class="checkbox" name="check['.$i.']" value="1" checked></td>
<td class="center"><img src="'.$new_goods[$i]['images'].'" width="150" />
	<input type="hidden" name="images[]" value="'.$new_goods[$i]['images'].'" />
	</td>
<td class="center"><input type="text" name="names[]" value="'.$new_goods[$i]['names'].'" size="100" />
	</td>
<td class="center"><input type="text" name="prices[]" value="'.$new_goods[$i]['prices'].'" size="10" />
	</td>
</tr>
					';
			
			
		}
	} else {
		echo 'Нет ссылки на парсинг';
	}
	echo '<tr><td colspan="4" align="center"><input type="submit" value="Сохранить"></td></tr>
			</form>
			</tbody>
			</table>
			  </div>
  </div>
  </div>
  </div>
  </div>
			
<script  type="text/javascript">
<!-- 
$(function () {
     $("#select_all").click(function() {
         if($("#select_all").is(":checked")){
              $(".checkbox").prop("checked",true);
         } else {
             $(".checkbox").prop("checked",false);
         }
     });
});

//-->
</script>
			';
} else {
	
if(!isset($_GET['edit_category']) && !isset($_GET['add_category'])) { // Список категорий
?>
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-list-alt"></i> Категории</h2>
</div>

<div class="box-content">

<div class="alert alert-info">
<a href="/admin/catalogs/?add_category=0" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Добавить новую категорию</a>
</div>
<?php echo $contentPage->printTreeCats(0, false) ?>
</div>
  </div>
  </div>
  </div>
  </div>
<script>
function openSubPage(id) {
    if($("#subpages"+id).css("display")=="none") var height = "show";
        else var height = "hide";
    $("#pages"+id).toggleClass("glyphicon-folder-open");
    $("#pages"+id).toggleClass("glyphicon-folder-close");
    $("#subpages"+id).animate({height: height}, 200);
    }
</script>
<?php
} else {
  $_GET['edit_category'] = intval($_GET['edit_category']);
  $_GET['add_category'] = intval($_GET['add_category']);
  
 if($_GET['edit_category'] > 0 && $_GET['add_category'] == 0) { // Редактирование страницы
       
 // Вывод формы
  $edit_categorys = dBShop::getContentCatById($_GET['edit_category']);
     
  if($edit_categorys['active'] == 1) $temp_view_menu = ' checked';
    else $temp_view_menu = '';
  if($edit_categorys['id'] == 1) $temporary_url = Engine::$settings['main_host'];
        else $temporary_url = Engine::$settings['main_host'].'catalog/'.$edit_categorys['url'].'/';
?>
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-globe"></i> Категории</h2>
</div>

<div class="box-content">
<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Редактируем категорию:</th>
</tr>
</thead>
<tbody>
  <form method="POST" action="/admin/catalogs/?edit_category=<?php echo $_GET['edit_category'] ?>">
  <tr><td>Название:</td><td><input type="text" name="edit_title" value="<?php echo $edit_categorys['title'] ?>" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" name="edit_url" value="<?php echo $edit_categorys['url'] ?>" size="100" /></td></tr>
  <tr><td>Родитель:</td><td><select name="edit_parent" id="edit_parent">
     <option value="0"> --- </option>
     <?php echo $contentPage->printParentCats() ?>
     </select>
  </td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1"<?php echo $temp_view_menu ?> /></td></tr>
  <tr><td>Html Parsing:</td><td><input type="text" name="parsing_source" value="<?php echo $edit_categorys['parsing_source'] ?>" size="100" /></td></tr>
  <tr><td>Data Parsing:</td><td><input type="text" name="parsing_data" value="<?php echo $edit_categorys['parsing_data'] ?>" size="100" /></td></tr>
  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_categorys['content'] ?></textarea></td></tr>
  <tr><td colspan="2"><a href="<?php echo $temporary_url; ?>" target="_blank" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-share-alt"></i> Показать на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php
  if($edit_categorys['parsing_source']!="") {
	echo '<a class="btn btn-default" href="/admin/catalogs/?parsing_goods='.$_GET['edit_category'].'"><i class="glyphicon glyphicon-download-alt"></i> Parsing</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		';
  }
  ?>
  <button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
  </form>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $("#edit_parent [value=\'<?php echo $edit_categorys['parent'] ?>\']").attr("selected", "selected");
  </script>

<?php
  }
  
 if(($_GET['add_category'] > 0 || $_GET['add_category'] == 0) && $_GET['edit_category'] == 0) { // Создаем новую страницу
 
   $edit_categorys = dBShop::getContentCatById($_GET['edit_category']);
?>
     
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-globe"></i> Категории</h2>
</div>

<div class="box-content">
<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Создаем новую категорию:</th>
</tr>
</thead>
<tbody>
  <form method="POST" action="/admin/catalogs/">
  <tr><td>Название:</td><td><input type="text" name="edit_title" value="" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" name="edit_url" value="" size="100" /></td></tr>
  <tr><td>Родитель:</td><td>
  	 <select name="edit_parent" id="edit_parent">
     <option value="0"> --- </option>
     <?php echo $contentPage->printParentCats() ?>
     </select>
  </td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1" checked /></td></tr>
  <tr><td>Html Parsing:</td><td><input type="text" name="parsing_source" value="" size="100" /></td></tr>
  <tr><td>Data Parsing:</td><td><input type="text" name="parsing_data" value="" size="100" /></td></tr>
  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_categorys['content'] ?></textarea></td></tr>
  <tr><td colspan="2"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
  </form>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $("#edit_parent [value=\'<?php echo $_GET['add_category'] ?>\']").attr("selected", "selected");
  </script>
<?php
 }   
}
}
?>