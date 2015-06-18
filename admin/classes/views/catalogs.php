<?php
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
  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_categorys['content'] ?></textarea></td></tr>
  <tr><td colspan="2"><a href="<?php echo $temporary_url; ?>" target="_blank" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-share-alt"></i> Показать на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
  <tr><td>Название:</td><td><input type="text" id="edit_title" name="edit_title" value="" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" id="edit_url" name="edit_url" value="" size="100" /></td></tr>
  <tr><td>Родитель:</td><td>
  	 <select name="edit_parent" id="edit_parent">
     <option value="0"> --- </option>
     <?php echo $contentPage->printParentCats() ?>
     </select>
  </td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1" checked /></td></tr>
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
     function translit(){
// Символ, на который будут заменяться все спецсимволы
var space = '-'; 
// Берем значение из нужного поля и переводим в нижний регистр
var text = $('#edit_title').val().toLowerCase();
     
// Массив для транслитерации
var transl = {
'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ё':'e','ж':'zh', 
'з':'z','и':'i','й':'j','к':'k','л':'l','м':'m','н':'n',
'о':'o','п':'p','р':'r','с':'s','т':'t','у':'u','ф':'f','х':'h',
'ц':'c','ч':'ch','ш':'sh','щ':'sh','ъ':'','ы':'y','ь':'','э':'e','ю':'yu','я':'ya',
' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
'#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
'(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
'{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
'?': space, '<': space, '>': space, '№':space
}
                
var result = '';
var curent_sim = '';
                
for(i=0; i < text.length; i++) {
    // Если символ найден в массиве то меняем его
    if(transl[text[i]] != undefined) {
         if(curent_sim != transl[text[i]] || curent_sim != space){
             result += transl[text[i]];
             curent_sim = transl[text[i]];
                                                        }                                                                             
    }
    // Если нет, то оставляем так как есть
    else {
        result += text[i];
        curent_sim = text[i];
    }                              
}          
                
result = TrimStr(result);               
                
// Выводим результат 
$('#edit_url').val(result); 
    
}
function TrimStr(s) {
    s = s.replace(/^-/, '');
    return s.replace(/-$/, '');
}
// Выполняем транслитерацию при вводе текста в поле
$(function(){
    $('#edit_title').keyup(function(){
         translit();
         return false;
    });
});
  </script>
<?php
 }   
}
?>