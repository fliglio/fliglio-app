# fliglio-app

## Install

- create composer.json and run "composer update"
- create an "app" folder and symlink in the example driver
- install your vhost 
- test your app

### composer.json
	
	{
	    "require": {
	        "fliglio/app": "dev-master"
	    },
		"minimum-stability" : "dev"
	}


### wire it up
	
	mkdir app
	ln -s vendor/fliglio/app/example/app/init.php app/init.php



### vhost-myapp

	<VirtualHost *:80>
	    DocumentRoot "/var/www/my-app/app"
	    ServerName fl.local
	    <Directory "/var/www/my-app/app">

	        RewriteEngine On
	        RewriteCond %{SCRIPT_FILENAME} -f [OR]
	        RewriteCond %{SCRIPT_FILENAME} -d
	        RewriteRule .+ - [L]

	        RewriteRule ^(.*)$ /init.php [L,QSA]

	        AllowOverride all
	        Order allow,deny
	        Allow from all
	    </Directory>
	</VirtualHost>


### Try it out

	curl http://fl.local/api/hello/world