Remy CMS

PHP

Add location for Nginx

	location / {
		index index.php;

		if (!-f $request_filename) {
			rewrite ^/(.*) /index.php?route=$1 last;
		}
		if ($request_uri ~ "\.(ini|php)$"){
			rewrite ^/(.*) /index.php?route=$1 last;
		}
	}

Add to .htaccess for Apache

        RewriteEngine on 
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ index.php?route=$1 [L,QSA]
