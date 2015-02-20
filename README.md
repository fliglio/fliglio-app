# fliglio-app

## Install

### application scaffolding
	
	composer create-project fliglio/app --dev

### docker

	docker build -t benschw/fl .
	docker run -t -d -p 80 benschw/fl

### vhost-myapp

	<VirtualHost *:80>
	    DocumentRoot "/var/www/my-app/web"
	    ServerName fl.local
	    <Directory "/var/www/my-app/web">

	        RewriteEngine On
	        RewriteCond %{SCRIPT_FILENAME} -f [OR]
	        RewriteCond %{SCRIPT_FILENAME} -d
	        RewriteRule .+ - [L]

	        RewriteRule ^(.*)$ /app.php [L,QSA]

	        AllowOverride all
	        Order allow,deny
	        Allow from all
	    </Directory>
	</VirtualHost>


### Try it out

	curl http://fl.local/api/foo
