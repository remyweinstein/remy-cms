<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title><?php echo Engine::$settings['var_meta_title']; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo Engine::$settings['var_meta_desc']; ?>" />
        <meta name="keywords" content="<?php echo Engine::$settings['var_meta_keys']; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo HOST_TEMPL; ?>css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="<?php echo HOST_RES; ?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo HOST_TEMPL; ?>js/unitpngfix.js"></script>
</head>
<body>
<div id="main_container">
  <div id="header">
    <div class="logo"> <a href="/"><img src="<?php echo HOST_TEMPL; ?>images/logo.png" width="221" height="91" alt="" border="0" /></a> </div>
    <div id="menu_tab">
      <ul class="menu">
        <li class="divider"></li>
        <li><a href="/about/" class="nav"> о нас </a></li>
        <li><a href="/payment/" class="nav"> оплата </a></li>
        <li><a href="/delivery/" class="nav"> доставка </a></li>
        <li><a href="/contacts/" class="nav"> контакты </a></li>
      </ul>
    </div>
    <div class="search_tab">
      <input type="text" class="search" value="поиск" />
      <input type="image" src="<?php echo HOST_TEMPL; ?>images/search.gif" class="search_bt" />
    </div>
  </div>
  <div id="main_content">
    <div class="left_sidebar">
      <div id="left_menu">
        <?php echo $Module->leftmenu; ?>
      </div>
      <div class="submenu_pic"> <img src="<?php echo HOST_TEMPL; ?>images/submenu_pic.gif" alt="" /> </div>
    </div>
    <div id="center_content">
	<?php echo $Module->content; ?>
    </div>
    <div class="clear"></div>
    <div id="footer">
      <div class="left_foter"><img src="<?php echo HOST_TEMPL; ?>images/footer_logo.gif" alt="" /></div>
      <div class="center_footer"><a href="/terms-delivery/">Условия доставки</a> | <a href="/terms/">Условия и правила</a> | <a href="/privacy/">Политика безопасности</a> | <a href="/contacts/">Контакты</a></div>
    </div>
  </div>
</div>
</body>
</html>
