<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-file"></i> Контент - Новая страница</h2>
</div>

<div class="box-content">
<table class="table table-striped">
<tbody>
  <form method="POST" action="/admin/pages/">
  <tr><td>Название:</td><td><input type="text" id="edit_title" name="edit_title" value="" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" id="edit_url" name="edit_url" value="" size="100" /></td></tr>
  <tr><td>Родитель:</td><td><select name="edit_parent" id="edit_parent">
    <option value="0"> --- </option>
	<?php echo $this->printParentPages() ?>
	</select>
    </td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1" checked /></td></tr>
  <tr><td>Шаблон:</td><td><?php echo $this->getNamesTemplates() ?></td></tr>
  <tr><td colspan="2">
   <textarea name="edit_content" style="width:100%;height:500px;"></textarea>
  </td></tr>
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
    $("#edit_parent [value=\'<?php echo $_GET['add_page'] ?>\']").attr("selected", "selected");
    $("#edit_template [value=\'<?php echo Engine::$settings['current_template'] ?>\']").attr("selected", "selected");
  
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
