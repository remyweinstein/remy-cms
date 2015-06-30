<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-file"></i> Контент - Редактирование страницы</h2>
</div>

<div class="box-content">
<table class="table table-striped">
<tbody>
  <form method="POST">
  <tr><td>Название:</td><td><input type="text" name="edit_title" value="<?php echo $this->edit_pages['title'] ?>" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" name="edit_url" value="<?php echo $this->edit_pages['url'] ?>" size="100" /></td></tr>
  <tr><td>Родитель:</td><td><select name="edit_parent" id="edit_parent">
    <option value="0"> --- </option>
	<?php echo $this->printParentPages() ?>
	</select>
	</td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1"<?php echo $this->temp_view_menu ?> /></td></tr>
  <tr><td>Шаблон:</td><td><?php echo $this->getNamesTemplates() ?></td></tr>
  <tr><td colspan="2">
   <textarea name="edit_content" style="width:100%;height:500px;"><?php echo $this->edit_pages['content'] ?></textarea>
  </td></tr>
  <tr><td colspan="2"><a href="<?php echo $this->temporary_url ?>" target="_blank" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-share-alt"></i> Показать на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    $("#edit_parent [value=\'<?php echo $this->edit_pages['parent'] ?>\']").attr("selected", "selected");
    $("#edit_template [value=\'<?php echo $this->edit_pages['template'] ?>\']").attr("selected", "selected");
  </script>