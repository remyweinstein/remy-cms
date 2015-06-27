<?php

if(isset($_GET['edit_item'])) {
	
	if($_GET['edit_item'] > 0) { // Редактирование товара
		 
		// Вывод формы
		$edit_items = dBShop::getItemById($_GET['edit_item']);
		 
		if($edit_items['active'] == 1) $temp_view_menu = ' checked';
		else $temp_view_menu = '';
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
	  <tr><td>Цена:</td><td><input type="text" name="edit_price" value="<?php echo $edit_items['price'] ?>" /></td></tr>
	  <tr><td>Цена закуп:</td><td><input type="text" name="edit_price_zakup" value="<?php echo $edit_items['price_zakup'] ?>" /></td></tr>
	  
	  <input type="hidden" name="edit_prop" value="<?php echo $edit_items['prop'] ?>" />
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
	  
	  <tr><td>Количество:</td><td><input type="text" name="edit_quantity" value="<?php echo $edit_items['quantity'] ?>" /></td></tr>
	  <tr><td>Вес:</td><td><input type="text" name="edit_weight" value="<?php echo $edit_items['weight'] ?>" /></td></tr>
	  <tr><td>Длина:</td><td><input type="text" name="edit_lenght" value="<?php echo $edit_items['lenght'] ?>" /></td></tr>

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
	   </script>
	
	<?php } else { // Создаем новый товар
	$add_link = ($_GET['get_cat']>0) ? '?category_id='.$_GET['get_cat'] : '';
	  ?>
	     
	<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
	<div class="box col-md-12">
	<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
	  <h2><i class="glyphicon glyphicon-globe"></i> Новый товар</h2>
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
	  <tr><td>Название:</td><td><input type="text" name="edit_title" value="" size="100" /></td></tr>
	  <tr><td>URL:</td><td><input type="text" name="edit_url" value="" size="100" /></td></tr>
	  <tr><td>Изображение:</td><td><input type="file" name="edit_pic_url" /></td></tr>
	  
	  <tr><td>Категория:</td><td><select name="edit_category" id="edit_category">
	     <?php echo $this->printCats() ?>
	     </select>
	  </td></tr>
	  <tr><td>Производитель:</td><td><select name="edit_country" id="edit_country">
	     <?php echo $this->printCountry() ?>
	     </select>
	  </td></tr>
	  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1" checked /></td></tr>
	  <tr><td>Цена:</td><td><input type="text" name="edit_price" value="" /></td></tr>
	  <tr><td>Цена закуп:</td><td><input type="text" name="edit_price_zakup" value="" /></td></tr>
	  
	  <input type="hidden" name="edit_prop" value="" />
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
	  	  
	  <tr><td>Количество:</td><td><input type="text" name="edit_quantity" value="" /></td></tr>
	  <tr><td>Вес:</td><td><input type="text" name="edit_weight" value="" /></td></tr>
	  <tr><td>Длина:</td><td><input type="text" name="edit_lenght" value="" /></td></tr> 
	  
	  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"></textarea></td></tr>
	  <tr><td colspan="2"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
	  </form>
	  </tbody>
	  </table>
	  <script>
	    $("#edit_category [value=\'<?php echo $_GET['get_cat'] ?>\']").attr("selected", "selected");
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
