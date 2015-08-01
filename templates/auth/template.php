<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo Engine::$settings['var_meta_title']; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script src="<?php echo HOST_RES; ?>js/jquery.min.js"></script>

        <link rel="stylesheet" href="<?php echo HOST_RES; ?>css/style.css" />
        <link rel="stylesheet" href="<?php echo HOST_RES; ?>css/style_auth.css" />
    </head>
    <body>
    <div class="login_panel">
    <?php echo Engine::$Module->content; ?>
    </div>
	</body>
</html>