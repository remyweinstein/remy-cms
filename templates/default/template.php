<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo Engine::$settings['var_meta_title']; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo Engine::$settings['var_meta_desc']; ?>" />
        <meta name="keywords" content="<?php echo Engine::$settings['var_meta_keys']; ?>" />
        
        <script type="text/javascript" src="<?php echo HOST_RES; ?>js/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo HOST_TEMPL; ?>css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Jura&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    </head>
    <body>
		<header>
			<div class="wrapper-header-top">
    			<div class="header-logo">
    				<img src="<?php echo HOST_TEMPL; ?>images/logo.png" alt="Astra Кухни">
    			</div>
    			<div class="header-menu">
    				<a href="" class="menu-articles">Блог</a>
    				<a href="" class="menu-gallery">Галерея</a>
    				<a href="" class="menu-contacts">Контакты</a>
    			</div>
    			<div class="header-phone">
    				Телефон: (4212) <span>93-10-23</span>
    			</div>
    		</div>
		</header>
		<menu>
		<div class="wrapper-header">
    <ul id="nav">
        <li><a href="#">Кухни</a>
            <ul>
        		<li><a href="/simply_kitchen/">Простые кухни</a></li>
        		<li><a href="/middle_kitchen/">Средняя цена</a></li>
        		<li><a href="/premium_kitchen/">Премиум кухни</a></li>
        		<li><a href="/">Быстрый расчет стоимости</a></li>
        	</ul>
        </li>
        <li><a href="#">Комплектующие</a>
            <ul>
        		<li><a href="/">Каркас</a></li>
        		<li><a href="/">Фасады</a></li>
        		<li><a href="/">Столешницы</a></li>
        		<li><a href="/">Фурнитура</a></li>
        		<li><a href="/">Наполнение</a></li>
        	</ul>
        </li>
        <li><a href="#">Услуги</a>
            <ul>
        		<li><a href="/">Заказать Замер</a></li>
        		<li><a href="/">Установка</a></li>
        		<li><a href="/">Замена столешницы</a></li>
        		<li><a href="/">Замена фасадов</a></li>
        		<li><a href="/">Полный спектр услуг</a></li>
        	</ul>
        </li>
        <li><a href="#">Контакты</a></li>
    </ul>	
        </div>
        </menu>
		<div class="wrapper-content">
		
		<?php include CORE_VIEWS.Engine::$curModule.".php"; ?>
		
    		<footer>
    			footer
    		</footer>
    	</div>
    </body>
</html>