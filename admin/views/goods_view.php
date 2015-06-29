<?php

if(isset($_GET['edit_item'])) {
	
	if($_GET['edit_item'] > 0) { // Редактирование товара
		 
		// Вывод формы
		$edit_items = dBShop::getItemById($_GET['edit_item']);
		 
		if($edit_items['active'] == 1) {
                    $temp_view_menu = ' checked';
                } else {
                    $temp_view_menu = '';
                }
		if($edit_items['new'] == 1) {
                    $temp_new = ' checked';
                } else {
                    $temp_new = '';
                }
		if($edit_items['favorite'] == 1) {
                    $temp_favorite = ' checked';
                } else {
                    $temp_favorite = '';
                }
		if($edit_items['id'] == 1) $temporary_url = Engine::$settings['main_host'];
		else $temporary_url = Engine::$settings['main_host'].'item/'.$edit_items['url'].'/';
		?>
	<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
	<div class="box col-md-12">
	<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
	  <h2><i class="glyphicon glyphicon-edit"></i> Редактирование товара</h2>
	</div>
	
	<div class="box-content">
	<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Редактируем товар:</th>
</tr>
</thead>
<tbody>
	  <form method="POST" action="/admin/goods/?category_id=<?php echo $edit_items['category'] ?>" enctype="multipart/form-data">
	  <tr><td>Название:</td><td><input type="text" name="edit_title" value="<?php echo $edit_items['title'] ?>" size="100" /></td></tr>
	  <tr><td>URL:</td><td><input type="text" name="edit_url" value="<?php echo $edit_items['url'] ?>" size="100" /></td></tr>

	  <?php
	  if($edit_items['pic_url'] == '') {
			echo '<tr><td>Изображение:</td><td><input type="file" name="edit_pic_url" /></td></tr>
			';
	  } else {
	  		echo '<tr><td>Изображение:</td><td><img src="'.Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$edit_items['pic_url'].'" width="120" />
	  		<a href="/admin/goods/?edit_item='.$_GET['edit_item'].'&delete_image=1">Удалить</a>
	  		<input type="hidden" name="edit_pic_url" value="'.$edit_items['pic_url'].'" />
			</td></tr>
			';
		}
	  ?>
	  
	  <tr><td>Категория:</td><td><select name="edit_category" id="edit_category">
	     <?php echo $this->printCats() ?>
	     </select>
	  </td></tr>
	  <tr><td>Производитель:</td><td><select name="edit_country" id="edit_country">
	     <?php echo $this->printCountry() ?>
	     </select>
	  </td></tr>
	  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1"<?php echo $temp_view_menu ?> /></td></tr>
	  <tr><td colspan="2">
                  Показывать товар:&nbsp;<input type="checkbox" name="edit_view_menu" value="1"<?php echo $temp_view_menu ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Новинках:&nbsp;<input type="checkbox" name="edit_new" value="1"<?php echo $temp_new ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Рекомендуемых:&nbsp;<input type="checkbox" name="edit_favorite" value="1"<?php echo $temp_favorite ?> />
          </td></tr>
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
<?php
$edit_variants = dBShop::getVariantsByItem($_GET['edit_item']);
for($i=0;$i<count($edit_variants);$i++) {
echo '	  <tr class="variants"><td colspan="2">
                Название:&nbsp;<input type="text" name="edit_variants_name[]" value="'.$edit_variants[$i]['name'].'" />&nbsp;
                Артикул:&nbsp;<input type="text" name="edit_variants_sku[]" value="'.$edit_variants[$i]['sku'].'" style="width:150px;" />&nbsp;
                Цена:&nbsp;<input type="text" name="edit_variants_price[]" value="'.$edit_variants[$i]['price'].'" style="width:60px;" />&nbsp;
                Старая цена:&nbsp;<input type="text" name="edit_variants_price_old[]" style="width:60px;" value="'.$edit_variants[$i]['old_price'].'" />&nbsp;
                Вес:&nbsp;<input type="text" name="edit_variants_weight[]" value="'.$edit_variants[$i]['weight'].'" style="width:50px;" />&nbsp;
                Количество:&nbsp;<input type="text" name="edit_variants_quantity[]" value="'.$edit_variants[$i]['quantity'].'" style="width:50px;" />&nbsp;&nbsp;
                <input type="hidden" name="edit_variants_pic_url[]" value= "'.$edit_variants[$i]['pic_url'].'" />
                <input type="hidden" name="edit_variants_id[]" value= "'.$edit_variants[$i]['id'].'" />
                <input type="hidden" name="edit_variants_id_item[]" value= "'.$edit_variants[$i]['id_item'].'" />
                <a href="/admin/goods/?edit_item='.$_GET['edit_item'].'&delete_variant='.$edit_variants[$i]['id'].'"><i class="glyphicon glyphicon-trash" alt="Удалить"></i></a>&nbsp;&nbsp;
                <a href="#" onClick="addVariant(); return false;" alt="Добавить новый"><i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить</a>
          </td></tr>
';
}
?>
	  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"><?php echo $edit_items['content'] ?></textarea></td></tr>
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
	    $("#edit_category [value=\'<?php echo $edit_items['category'] ?>\']").attr("selected", "selected");
	    $("#edit_country [value=\'<?php echo $edit_items['country'] ?>\']").attr("selected", "selected");
            function addVariant() {
                var id = Math.floor(Math.random() * (999999 - 123211 + 1)) + 123211;
                $(".variants").after('<tr id="'+id+'"><td colspan="2">Название:&nbsp;<input type="text" name="variants_name[]" value="" />&nbsp;&nbsp;Артикул:&nbsp;<input type="text" name="variants_sku[]" value="" style="width:150px;" />&nbsp;&nbsp;Цена:&nbsp;<input type="text" name="variants_price[]" value="" style="width:60px;" />&nbsp;&nbsp;Старая цена:&nbsp;<input type="text" name="variants_price_old[]" style="width:60px;" value="" />&nbsp;&nbsp;Вес:&nbsp;<input type="text" name="variants_weight[]" value="" style="width:50px;" />&nbsp;&nbsp;Количество:&nbsp;<input type="text" name="variants_quantity[]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="deleteVariant(\''+id+'\'); return false;">Удалить</a><input type="hidden" name="variants_pic_url[]" /></td></tr>');
            }
            function deleteVariant(id) {
                $('#'+id).remove();
            }
	   </script>
	
	<?php } else { // Создаем новый товар
	$add_link = ($_GET['get_cat']>0) ? '?category_id='.$_GET['get_cat'] : '';
	  ?>
	     
	<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
	<div class="box col-md-12">
	<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
	  <h2><i class="glyphicon glyphicon-edit"></i> Новый товар</h2>
	</div>
	
	<div class="box-content">
	<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Создаем новый товар:</th>
</tr>
</thead>
<tbody>
	<form method="POST" action="/admin/goods/<?php echo $add_link ?>" enctype="multipart/form-data">
	  <tr><td>Название:</td><td><input type="text" id="edit_title" name="edit_title" value="" size="100" /></td></tr>
	  <tr><td>URL:</td><td><input type="text" id="edit_url" name="edit_url" value="" size="100" /></td></tr>
	  <tr><td>Изображение:</td><td><input type="file" name="edit_pic_url" /></td></tr>
	  
	  <tr><td>Категория:</td><td><select name="edit_category" id="edit_category">
	     <?php echo $this->printCats() ?>
	     </select>
	  </td></tr>
	  <tr><td>Производитель:</td><td><select name="edit_country" id="edit_country">
	     <?php echo $this->printCountry() ?>
	     </select>
	  </td></tr>
	  <tr><td colspan="2">
                  Показывать товар:&nbsp;<input type="checkbox" name="edit_view_menu" value="1" checked />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Новинках:&nbsp;<input type="checkbox" name="edit_new" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Рекомендуемых:&nbsp;<input type="checkbox" name="edit_favorite" value="1" />
          </td></tr>
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
	  <tr class="variants"><td colspan="2">
                Название:&nbsp;<input type="text" name="variants_name[]" value="" />&nbsp;
                Артикул:&nbsp;<input type="text" name="variants_sku[]" value="" style="width:150px;" />&nbsp;
                Цена:&nbsp;<input type="text" name="variants_price[]" value="" style="width:60px;" />&nbsp;
                Старая цена:&nbsp;<input type="text" name="variants_price_old[]" style="width:60px;" value="" />&nbsp;
                Вес:&nbsp;<input type="text" name="variants_weight[]" value="" style="width:50px;" />&nbsp;
                Количество:&nbsp;<input type="text" name="variants_quantity[]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" onClick="addVariant(); return false;"><i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить</a>
                <input type="hidden" name="variants_pic_url[]" value= "" />
          </td></tr>
          <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"></textarea></td></tr>
	  <tr><td colspan="2"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
	  </form>
	  </tbody>
	  </table>
	  <script>
	    $("#edit_category [value=\'<?php echo $_GET['get_cat'] ?>\']").attr("selected", "selected");
            function addVariant() {
                var id = Math.floor(Math.random() * (999999 - 123211 + 1)) + 123211;
                $(".variants").after('<tr id="'+id+'"><td colspan="2">Название:&nbsp;<input type="text" name="variants_name[]" value="" />&nbsp;&nbsp;Артикул:&nbsp;<input type="text" name="variants_sku[]" value="" style="width:150px;" />&nbsp;&nbsp;Цена:&nbsp;<input type="text" name="variants_price[]" value="" style="width:60px;" />&nbsp;&nbsp;Старая цена:&nbsp;<input type="text" name="variants_price_old[]" style="width:60px;" value="" />&nbsp;&nbsp;Вес:&nbsp;<input type="text" name="variants_weight[]" value="" style="width:50px;" />&nbsp;&nbsp;Количество:&nbsp;<input type="text" name="variants_quantity[]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="deleteVariant(\''+id+'\'); return false;">Удалить</a><input type="hidden" name="variants_pic_url[]" value= "" /></td></tr>');
            }
            function deleteVariant(id) {
                $('#'+id).remove();
            }
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
	<?php
	 } 
	
	
} else {  // С П И С О К   Т О В А Р О В 

	if(!isset($_GET['category_id'])) {
		$category = 0;
		$h2_category['title'] = 'Все категории';
	} else {
		$category = $_GET['category_id'];
		$h2_category = dBShop::getTitleCategory($category);
	}

	$arr_items = dBShop::getAllItems($category);
	
	$list_countries = $this->country_title;
	
	
echo '<div id="content" class="col-lg-10 col-sm-10">
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-gift"></i> Товары - '.$h2_category['title'].'</h2>
        </div>
        <div class="box-content">
<div class="alert alert-info">
<a href="/admin/goods/?edit_item=0&get_cat='.$category.'" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Добавить новый товар</a>
</div>
		<table class="table table-striped">
		  <thead>
		  <tr>
		  <th>Картинка</th>
		  <th>Название</th>
		  <th>Цена</th>
		  <th>Наличие</th>
		
		  <th>Действия</th>
		  </tr>
		  </thead>
		  <tbody>
';
for($i=0;$i<count($arr_items);$i++) {
	
echo '<tr>
<td class="center"><img src="'.Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$arr_items[$i]['pic_url'].'" width="120" />
	<input type="hidden" name="pic_url[]" value="'.$arr_items[$i]['pic_url'].'" />
	</td>
<td class="center">'.$arr_items[$i]['title'].'
	<input type="hidden" name="title[]" value="'.$arr_items[$i]['title'].'" />
			';
$title_category = dBShop::getTitleCategory($arr_items[$i]['category']);
echo '<br>Категория: <a href="/admin/goods/?category_id='.$arr_items[$i]['category'].'">'.$title_category['title'].'</a>
		<br>Производитель: '.$list_countries[($arr_items[$i]['country']-1)]['title'];

echo '		</td>
<td class="center">'.$arr_items[$i]['price'].'
	<input type="hidden" name="price[]" value="'.$arr_items[$i]['price'].'" />
	</td>
<td class="center">';
	echo ($arr_items[$i]['quantity']==0) ? 'Под заказ' : 'В наличии';
	echo '<input type="hidden" name="quantity[]" value="'.$arr_items[$i]['quantity'].'" />
	</td>
<td class="center">
	<a href="/admin/goods/?delete_item='.$arr_items[$i]['id'].'" alt="Удалить" title="Удалить"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;
	<a href="/admin/goods/?edit_item='.$arr_items[$i]['id'].'" alt="Редактировать" title="Редактировать"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;';
	echo ($arr_items[$i]['quantity'] == 0) ? '<a href="#" alt="Установить В наличии" title="Установить В наличии"><i class="glyphicon glyphicon-inbox"></i></a>&nbsp;&nbsp;' : '<a href="#" alt="Установить Под заказ" title="Установить Под заказ"><i class="glyphicon glyphicon-time"></i></a>&nbsp;&nbsp;'; 
	echo ($arr_items[$i]['active'] == 0) ? '<a href="#" alt="Показывать на сайте" title="Показывать на сайте"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;&nbsp;' : '<a href="#" alt="Не показывать на сайте" title="Не показывать на сайте"><i class="glyphicon glyphicon-eye-close"></i></a>&nbsp;&nbsp;'; 
	echo '
	</td>
</tr>
	';	
	
	
}
echo '			</tbody>
			</table>
        </div>
      </div>
    </div>
  </div>
</div>
';
}
