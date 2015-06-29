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
<?php echo $this->printTreeCats(0, false) ?>
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