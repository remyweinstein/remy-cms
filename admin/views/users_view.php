<?php
if(!isset($_GET['id_user'])) {
	
$count_user = dB::countAllUsers();
if(!isset($_GET['page'])) $active_page = 1;
    else $active_page = intval($_GET['page']);
$display_of = 20;
?>

<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-user"></i> Пользователи</h2>
</div>

<div class="box-content">

<div class="alert alert-info">
<a href="/admin/users/?add_user=0" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Добавить нового пользователя</a>
</div>

<table class="table table-striped">
<thead>
<tr>
<th>&nbsp;</th>
<th>Логин</th>
<th>Имя</th>
<th>email</th>
<th>Регистрация</th>
<th>Посл. посещ.</th>
<th>Уровень</th>
<th>Статус</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>

<?php
$admin_users = dB::getListUsers($display_of, $active_page-1);
for($i=0;$i<count($admin_users);$i++) {
    if($admin_users[$i]['picture'] == "") $picture_user_admin = "&nbsp;";
        else $picture_user_admin = '<img src="../users/pics/'.$admin_user['picture'].'.jpg" />';
    if($admin_users[$i]['new']==1) $admin_new_user = '&nbsp;<i class="glyphicon glyphicon-asterisk red"></i>';
        else $admin_new_user = '';
?>
<tr>
<td><?php echo $picture_user_admin ?></td>
<td><?php echo $admin_users[$i]['login'].$admin_new_user ?></td>
<td><?php echo $admin_users[$i]['name'] ?></td>
<td><?php echo $admin_users[$i]['email'] ?></td>
<td class="center"><?php echo Format::Viewdate($admin_users[$i]['date_reg']) ?></td>
<td class="center"><?php echo Format::Viewdate($admin_users[$i]['date_last']) ?></td>
<td class="center"><?php echo $admin_users[$i]['level'] ?></td>
<td class="center">
<span class="label-success label label-default"><?php echo $admin_users[$i]['status'] ?></span>
</td>
<td class="center"><a href="/admin/users/?id_user=<?php echo $admin_users[$i]['id'] ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php echo Engine::PaginatorView($active_page, $count_user, $display_of, '/admin/users/', 'page') ?>
</div>
</div>
</div>
</div>
</div>
<?php
dB::checkNewUsers();
} else {
    $admin_user = dB::getUserById($_GET['id_user']);
    if($admin_user['picture'] == "") $picture_user_admin = "&nbsp;";
        else $picture_user_admin = '<img src="../users/pics/'.$admin_user['picture'].'.jpg" />';
?>
    <div id="content" class="col-lg-10 col-sm-10">
    <div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-user"></i> Пользователи</h2>
</div>

<div class="box-content">

    <div style="width:400px;">
    <h4>Редактирование пользователя <strong><?php echo $admin_user['login'] ?></strong></h4>
    <form method="POST" action="/admin/users/">
    <input type="hidden" name="edit_user_id" value="<?php echo $admin_user['id'] ?>" />
    <table class="table table-striped">
<tbody>
<tr>
<td colspan="2"><?php echo $picture_user_admin ?></td>
</tr>
<tr>
<td>Логин:</td><td><input type="text" name="edit_login" value="<?php echo $admin_user['login'] ?>" /></td>
</tr>
<tr>
<td>Имя:</td><td><input type="text" name="edit_name" value="<?php echo $admin_user['name'] ?>" /></td>
</tr>
<tr>
<td>Email:</td><td><input type="text" name="edit_email" value="<?php echo $admin_user['email'] ?>" /></td>
</tr>
<tr>
<td>Регистрация:</td><td><?php echo Format::Viewdate($admin_user['date_reg']) ?></td>
</tr>
<tr>
<td>Посл. вход:</td><td><?php echo Format::Viewdate($admin_user['date_last']) ?></td>
</tr>
<tr>
<td>Уровень:</td><td><input type="text" name="edit_level" value="<?php echo $admin_user['level'] ?>" /></td>
</tr>
<tr>
<td>Статус:</td><td><input type="text" name="edit_status" value="<?php echo $admin_user['status'] ?>" /></td>
</tr>
</tbody>
</table>
<p style="text-align:center;width:100%;"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></p>
</form>
</div>
</div>
</div>
</div>
</div>
</div>    
<?php } ?>