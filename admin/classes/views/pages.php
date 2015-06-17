<?php
if(!isset($_GET['edit_page']) && !isset($_GET['add_page'])) {

?>
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-file"></i> Контент</h2>
</div>

<div class="box-content">

<div class="alert alert-info">
<a href="/admin/pages/?add_page=0" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Добавить новую страницу</a>
</div>

<?php echo $contentPage->printTreePages(0) ?>

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
	
  $_GET['edit_page'] = intval($_GET['edit_page']);
  $_GET['add_page'] = intval($_GET['add_page']);
  
 if($_GET['edit_page'] > 0 && $_GET['add_page'] == 0) { // Редактирование страницы

  $edit_pages = dB::getContentPageById($_GET['edit_page']);
  
  if($edit_pages['view_menu'] == 1) $temp_view_menu = ' checked';
    else $temp_view_menu = '';
    
  if($edit_pages['id'] == 1) $temporary_url = Engine::$settings['main_host'];
    else $temporary_url = Engine::$settings['main_host'].$edit_pages['url'].'/';

?>

<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-file"></i> Контент</h2>
</div>

<div class="box-content">
  <form method="POST">
  <p>Название: <input type="text" name="edit_title" value="<?php echo $edit_pages['title'] ?>" /></p>
  <p>URL: <input type="text" name="edit_url" value="<?php echo $edit_pages['url'] ?>" /></p>
  <p>Родитель: <select name="edit_parent" id="edit_parent">
    <option value="0"> --- </option>
	<?php echo $contentPage->printParentPages() ?>
	</select>
	</p>
  <p>Показывать в меню: <input type="checkbox" name="edit_view_menu" value="1"<?php echo $temp_view_menu ?> /></p>
  <p>Шаблон: <?php echo $contentPage->getNamesTemplates() ?></p>
  <p>
   <textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_pages['content'] ?></textarea>
  </p>
  <p><a href="<?php echo $temporary_url ?>" target="_blank" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-share-alt"></i> Показать на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></p>
  </form>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $("#edit_parent [value=\'<?php echo $edit_pages['parent'] ?>\']").attr("selected", "selected");
    $("#edit_template [value=\'<?php echo $edit_pages['template'] ?>\']").attr("selected", "selected");
  </script>
  
<?php 
 }
  
 if(($_GET['add_page'] > 0 || $_GET['add_page'] == 0) && $_GET['edit_page'] == 0) { // Создаем новую страницу
 
  $edit_pages = dB::getContentPageById($_GET['edit_page']);
     
  if($edit_pages['view_menu'] == 1) $temp_view_menu = ' checked';
    else $temp_view_menu = '';  
?>
    
<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-file"></i> Контент</h2>
</div>

<div class="box-content">
  <form method="POST" action="/admin/pages/">
  <p>Название: <input type="text" name="edit_title" value="<?php echo $edit_pages['title'] ?>" /></p>
  <p>URL: <input type="text" name="edit_url" value="<?php echo $edit_pages['url'] ?>" /></p>
  <p>Родитель: <select name="edit_parent" id="edit_parent">
    <option value="0"> --- </option>
	<?php echo $contentPage->printParentPages() ?>
	</select>
	</p>
  <p>Показывать в меню: <input type="checkbox" name="edit_view_menu" value="1"<?php echo $temp_view_menu ?> /></p>
  <p>Шаблон: <?php echo $contentPage->getNamesTemplates() ?></p>
  <p>
   <textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_pages['content'] ?></textarea>
  </p>
  <p><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></p>
  </form>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $("#edit_parent [value=\'<?php echo $_GET['add_page'] ?>\']").attr("selected", "selected");
    $("#edit_template [value=\'<?php echo Engine::$settings['current_template'] ?>\']").attr("selected", "selected");
  </script>
<?php
 }
}
?>