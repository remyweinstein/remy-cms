	<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
	<div class="box col-md-12">
	<div class="box-inner">
	
	<div class="box-header well" data-original-title="">
	  <h2><i class="glyphicon glyphicon-edit"></i> Товары - Редактирование товара</h2>
	</div>
	
	<div class="box-content">
	  <form method="POST" action="/admin/goods/?category_id=<?php echo $this->edit_items['category'] ?>" enctype="multipart/form-data">
	<table class="table table-striped">
<thead>
<tr>
<th colspan="2">Редактируем товар:</th>
</tr>
</thead>
<tbody>
	  <tr><td>Название:</td><td><input type="text" name="edit_title" value="<?php echo $this->edit_items['title'] ?>" size="100" /></td></tr>
	  <tr><td>URL:</td><td><input type="text" name="edit_url" value="<?php echo $this->edit_items['url'] ?>" size="100" /></td></tr>

	  <?php
	  if($this->edit_items['pic_url'] == '') {
			echo '<tr><td>Изображение:</td><td><input type="file" name="edit_pic_url" /></td></tr>
			';
	  } else {
	  		echo '<tr><td>Изображение:</td><td><img src="'.Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$this->edit_items['pic_url'].'" width="120" />
	  		<a href="/admin/goods/?edit_item='.$_GET['edit_item'].'&delete_image=1">Удалить</a>
	  		<input type="hidden" name="edit_pic_url" value="'.$this->edit_items['pic_url'].'" />
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
	  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1"<?php echo $this->temp_view_menu ?> /></td></tr>
	  <tr><td colspan="2">
                  Показывать товар:&nbsp;<input type="checkbox" name="edit_view_menu" value="1"<?php echo $this->temp_view_menu ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Новинках:&nbsp;<input type="checkbox" name="edit_new" value="1"<?php echo $this->temp_new ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                  Показывать в Рекомендуемых:&nbsp;<input type="checkbox" name="edit_favorite" value="1"<?php echo $this->temp_favorite ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="#" onClick="addVariant(); return false;" alt="Добавить новый"><i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить вариант</a>
          </td></tr>
	  <input type="hidden" name="edit_item" value="<?php echo $_GET['edit_item'] ?>" />
<?php
$edit_variants = dBShop::getVariantsByItem($_GET['edit_item']);
for($i=0;$i<count($edit_variants);$i++) {
$dop_class = (count($edit_variants)==($i+1)) ? ' class="variants"' : '';
echo '	  <tr'.$dop_class.'><td colspan="2">
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
          </td></tr>
';
}
if(count($edit_variants)==0) echo '<tr class="variants"><td colspan="2"></td></tr>';
?>
	  <tr><td colspan="2"><textarea name="edit_annotation" style="width:100%;height:200px;"><?php echo $this->edit_items['annotation'] ?></textarea></td></tr>
	  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"><?php echo $this->edit_items['content'] ?></textarea></td></tr>
	  <tr><td colspan="2"><a href="<?php echo $this->temporary_url; ?>" target="_blank" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-share-alt"></i> Показать на сайте</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
</tbody>
</table>
	  </form>
	  </div>
	  </div>
	  </div>
	  </div>
	  </div>
	  <script>
	    $("#edit_category [value=\'<?php echo $this->edit_items['category'] ?>\']").attr("selected", "selected");
	    $("#edit_country [value=\'<?php echo $this->edit_items['country'] ?>\']").attr("selected", "selected");
            function addVariant() {
                var id = Math.floor(Math.random() * (999999 - 123211 + 1)) + 123211;
                $(".variants").after('<tr id="'+id+'"><td colspan="2">Название:&nbsp;<input type="text" name="variants_name[]" value="" />&nbsp;&nbsp;Артикул:&nbsp;<input type="text" name="variants_sku[]" value="" style="width:150px;" />&nbsp;&nbsp;Цена:&nbsp;<input type="text" name="variants_price[]" value="" style="width:60px;" />&nbsp;&nbsp;Старая цена:&nbsp;<input type="text" name="variants_price_old[]" style="width:60px;" value="" />&nbsp;&nbsp;Вес:&nbsp;<input type="text" name="variants_weight[]" value="" style="width:50px;" />&nbsp;&nbsp;Количество:&nbsp;<input type="text" name="variants_quantity[]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="deleteVariant(\''+id+'\'); return false;">Удалить</a><input type="hidden" name="variants_pic_url[]" /></td></tr>');
            }
            function deleteVariant(id) {
                $('#'+id).remove();
            }
	   </script>