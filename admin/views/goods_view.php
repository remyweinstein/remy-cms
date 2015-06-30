<div id="content" class="col-lg-10 col-sm-10">
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-gift"></i> Товары <?php echo $this->h2_category ?></h2>
        </div>
        <div class="box-content">
<div class="alert alert-info">
<a href="/admin/goods/?edit_item=0&get_cat=<?php echo $this->category ?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Добавить новый товар</a>
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
<?php echo $this->printListGoods($this->category) ?>
</tbody>
</table>
</div>
</div>
</div>
  </div>
</div>