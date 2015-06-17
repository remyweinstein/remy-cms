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
    <div class="logo"> <a href="#"><img src="<?php echo HOST_TEMPL; ?>images/logo.png" width="221" height="91" alt="" border="0" /></a> </div>
    <div id="menu_tab">
      <ul class="menu">
        <li class="divider"></li>
        <li><a href="#" class="nav_selected"> home </a></li>
        <li><a href="about.html" class="nav"> about us</a></li>
        <li><a href="#" class="nav"> most wanted</a></li>
        <li><a href="#" class="nav"> how to order</a></li>
        <li><a href="contact.html" class="nav"> contact </a></li>
      </ul>
    </div>
    <div class="search_tab">
      <input type="text" class="search" value="search" />
      <input type="image" src="<?php echo HOST_TEMPL; ?>images/search.gif" class="search_bt" />
    </div>
  </div>
  <div id="main_content">
    <div class="left_sidebar">
      <div id="left_menu">
        <ul>
          <li><a href="categories.html">beauty</a></li>
          <li><a href="#">current ranges</a></li>
          <li><a href="#">classic ranges</a></li>
          <li><a href="#">accessories</a></li>
          <li class="selected"><a href="#">swimwear</a></li>
          <li><a href="#">classic ranges</a></li>
          <li><a href="#">accessories</a></li>
          <li><a href="#">swimwear</a></li>
        </ul>
      </div>
      <div class="submenu_pic"> <img src="<?php echo HOST_TEMPL; ?>images/submenu_pic.gif" alt="" /> </div>
    </div>
    <div id="center_content">
	<?php include CORE_VIEWS.Engine::$curModule.".php"; ?>
    </div>
    <div class="clear"></div>
    <div id="footer">
      <div class="left_foter"><img src="<?php echo HOST_TEMPL; ?>images/footer_logo.gif" alt="" /></div>
      <div class="center_footer"> <a href="#">Shipping Terms</a> | <a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a> </div>
    </div>
  </div>
</div>
</body>
</html>
