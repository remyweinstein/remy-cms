<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-search"></i> Поиск</h2>
</div>

<div class="box-content">

<h3>Поиск: <strong><?php echo $_POST['query'] ?></strong></h3>
<p>&nbsp;</p>
<ul><h4>В заголовке:</h4>
<?php
$result = dB::searchPagesForTitle($_POST['query']);
if($result) {
	for($i=0;$i<count($result);$i++) {
?>
		<li class="admin_page">
		<a href="/admin/pages/?delete_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-trash"></i></a>
		<a href="/admin/pages/?add_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-plus"></i></a>
		<a href="/admin/pages/?edit_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-edit"></i>
		<span><?php echo $result[$i]['title'] ?></span></a>
		</li>
<?php
	}
} else {
	?>
	<li class="admin_page">Не найдено</li>
	<?php
}
?>
</ul>
<ul><h4>В контенте:</h4>
<?php
$result = dB::searchPagesForContent($_POST['query']);
if($result) {
	for($i=0;$i<count($result);$i++) {
?>
		<li class="admin_page">
		<a href="/admin/pages/?delete_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-trash"></i></a>
		<a href="/admin/pages/?add_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-plus"></i></a>
		<a href="/admin/pages/?edit_page=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-edit"></i>
		<span><?php echo $result[$i]['title'] ?></span></a>
		</li>
	<?php
	}	
} else {
?>
<li class="admin_page">Не найдено</li>
<?php
}
?>
</ul>
<ul><h4>В каталоге:</h4>
<?php
$result = dBShop::searchForCatalog($_POST['query']);
if($result) {
	for($i=0;$i<count($result);$i++) {
?>
		<li class="admin_page">
		<a href="/admin/catalogs/?delete_category=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-trash"></i></a>
		<a href="/admin/catalogs/?add_category=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-plus"></i></a>
		<a href="/admin/catalogs/?edit_category=<?php echo $result[$i]['id'] ?>"><i class="glyphicon glyphicon-edit"></i>
		<span><?php echo $result[$i]['title'] ?></span></a>
		</li>
	<?php
	}	
} else {
?>
<li class="admin_page">Не найдено</li>
<?php
}
?>
</ul>
</div>
</div>
</div>
</div>
</div>