<!DOCTYPE html>
<html lang="ru">
<head>
 
<meta charset="utf-8">
<title>Админ Панель <?php echo Engine::$settings['main_name'] ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<link id="bs-css" href="<?php echo HOST_TEMPL ?>css/bootstrap-cerulean.min.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/charisma-app.css" rel="stylesheet">


<link href="<?php echo HOST_TEMPL ?>css/chosen.min.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/colorbox.css" rel="stylesheet">


<link href="<?php echo HOST_TEMPL ?>css/jquery.noty.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/noty_theme_default.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/elfinder.min.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/elfinder.theme.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/jquery.iphone.toggle.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/uploadify.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo HOST_TEMPL ?>css/bootstrap-wysiwyg.css" rel="stylesheet">

<script src="<?php echo HOST_TEMPL ?>js/jquery.min.js"></script>
<script src="<?php echo HOST_TEMPL ?>js/bootstrap-wysiwyg.js"></script>

 
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>
 
<div class="navbar navbar-default" role="navigation">
<div class="navbar-inner">
<button type="button" class="navbar-toggle pull-left animated flip">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/"> <span><?php echo Engine::$settings['main_name'] ?></span></a>
<div class="btn-group pull-right">
<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
<i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo ($user->Name == "") ? $user->Login : $user->Name ?></span>
<span class="caret"></span>
</button>
<ul class="dropdown-menu">
<li><a href="/admin/users/?id_user=<?php echo $user->Id ?>">Редактировать</a></li>
<li class="divider"></li>
<li><a href="/logout/?logout=yes">Выйти</a></li>
</ul>
</div>
 
<ul class="collapse navbar-collapse nav navbar-nav top-menu">
<li><a href="<?php echo Engine::$settings['main_host'] ?>" target="_blank"><i class="glyphicon glyphicon-globe"></i> На сайт</a></li>
<li class="dropdown">
<a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Избранное <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li><a href="#">Action</a></li>
<li><a href="#">Another action</a></li>
<li><a href="#">Something else here</a></li>
</ul>
</li>
<li>
<form class="navbar-search pull-left" action="/admin/searches/" method="POST">
<input placeholder="Поиск" class="search-query form-control col-md-10" name="query" type="text">
</form>
</li>
</ul>
</div>
</div>

<div class="ch-container">
<div class="row">
<div class="col-sm-2 col-lg-2">
<div class="sidebar-nav">
<div class="nav-canvas">
<div class="nav-sm nav nav-stacked">
</div>
<ul class="nav nav-pills nav-stacked main-menu">
<li class="nav-header">Основное</li>
<li><a class="ajax-link" href="/admin/"><i class="glyphicon glyphicon-home"></i><span> Главная</span></a>
</li>
<li><a class="ajax-link" href="/admin/pages/"><i class="glyphicon glyphicon-file"></i><span> Контент</span></a>
</li>
<li><a class="ajax-link" href="/admin/catalogs/"><i class="glyphicon glyphicon-list-alt"></i><span> Каталог</span></a>
</li>
<li><a class="ajax-link" href="/admin/goods/"><i class="glyphicon glyphicon-gift"></i><span> Товары</span></a>
</li>
<li><a class="ajax-link" href="/admin/users/"><i class="glyphicon glyphicon-user"></i><span> Пользователи</span></a>
</li>
<li><a class="ajax-link" href="/admin/settings/"><i class="glyphicon glyphicon-cog"></i><span> Настройки</span></a>
</li>
</ul>
</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<noscript>
<div class="alert alert-block col-md-12">
<h4 class="alert-heading">Warning!</h4>
<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
enabled to use this site.</p>
</div>
</noscript>

<?php echo $Module->content ?>

<hr>
</div>
<footer class="row">
<p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="<?php echo Engine::$settings['main_host'] ?>" target="_blank"><?php echo Engine::$settings['main_name'] ?></a> <?php echo date("Y") ?></p>
<p class="col-md-3 col-sm-3 col-xs-12 powered-by">Разработано <a href="http://remy-weinstein.ru/">Remy Weinstein</a></p>
</footer>
</div> 
 
<script src="<?php echo HOST_TEMPL; ?>js/charisma.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/bootstrap.min.js"></script> 
<script src="<?php echo HOST_TEMPL; ?>js/jquery.cookie.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/chosen.jquery.min.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.colorbox-min.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.noty.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.raty.min.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.iphone.toggle.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.autogrow-textarea.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.uploadify-3.1.min.js"></script>
<script src="<?php echo HOST_TEMPL; ?>js/jquery.history.js"></script>
</body>
</html>