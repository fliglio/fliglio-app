# fliglio-app

## Set up your doc root

create composer.json and run "composer update"
	
	{
	    "require": {
	        "fliglio/app": "dev-master"
	    },
	    "autoload": {
	        "psr-0": { "MyApp\\": "app/" }
	    }
	}

or grab the example template from this git repo: 

	git clone https://github.com/benschw/fliglio-app.git
	cp -r fliglio-app/example /var/www/my-app
	cd /var/www/my-app
	composer update


## Set up a vhost

	<VirtualHost *:80>
	    DocumentRoot "/var/www/my-app/app"
	    ServerName fl.local
	    <Directory "/var/www/my-app/app">

	        RewriteEngine On
	        RewriteCond %{SCRIPT_FILENAME} -f [OR]
	        RewriteCond %{SCRIPT_FILENAME} -d
	        RewriteRule .+ - [L]

	        RewriteRule ^api/(.*)$ /init.php?fliglio_request=/api/$1 [L,QSA]
	        RewriteRule ^(.*)$ /index.html#$1 [L,QSA]

	        AllowOverride all
	        Order allow,deny
	        Allow from all
	    </Directory>
	</VirtualHost>


## Try it out

curl http://fl.local/api/hello/world