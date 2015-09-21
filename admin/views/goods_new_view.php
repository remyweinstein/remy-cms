	<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
	<div class="box col-md-12">
	<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
	  <h2><i class="glyphicon glyphicon-edit"></i> Товары - Новый товар</h2>
	</div>
	
	<div class="box-content">
	<form method="POST" action="/admin/goods/<?php echo $this->add_link ?>" enctype="multipart/form-data">
	<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Создаем новый товар:</th>
</tr>
</thead>
<tbody>
	  <tr><td>Название:</td><td><input type="text" id="edit_title" name="edit_title" value="" size="100" /></td></tr>
	  <tr><td>URL:</td><td><input type="text" id="edit_url" name="edit_url" value="" size="100" /></td></tr>
	  <tr><td>Изображение:</td><td><input type="file" name="edit_pic_url" /></td></tr>
	  
	  <tr><td>Категория:</td><td>
	     <?php echo $this->model->printCatsForGoods($this->category) ?>
	  </td></tr>
	  <tr><td colspan="2">
                        <?php
                        echo $this->model->printPropsForGoods($this->category, 0);
                        ?>
          </td></tr>
	  <tr><td colspan="2">
                  Показывать товар:&nbsp;<input type="checkbox" name="edit_view_menu" value="1" checked />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Новинках:&nbsp;<input type="checkbox" name="edit_new" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Рекомендуемых:&nbsp;<input type="checkbox" name="edit_favorite" value="1" />
          </td></tr>
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
	  <tr><td colspan="2">
                        <?php 
                        echo $this->model->printSkus($this->category, $this->id_tov);
                        ?>
          </td></tr>
          <tr class="variants" id="sku_varint_0"><td colspan="2">
                Артикул:&nbsp;<input type="text" name="variants_articul[0]" value="" style="width:150px;" />&nbsp;
                Цена:&nbsp;<input type="text" name="variants_price[0]" value="" style="width:60px;" />&nbsp;
                Старая цена:&nbsp;<input type="text" name="variants_price_old[0]" style="width:60px;" value="" />&nbsp;
                Вес:&nbsp;<input type="text" name="variants_weight[0]" value="" style="width:50px;" />&nbsp;
                Количество:&nbsp;<input type="text" name="variants_quantity[0]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="variants_skus[0]" value= "" />
          </td></tr>
	  <tr><td colspan="2"><textarea name="edit_annotation" style="width:100%;height:200px;"><?php echo $edit_items['annotation'] ?></textarea></td></tr>
          <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"></textarea></td></tr>
	  <tr><td colspan="2"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
	  </tbody>
	  </table>
	  </form>
	  <script>

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
	  </div>
	  </div>
	  </div>
	  </div>
	  </div>