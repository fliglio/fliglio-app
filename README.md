# fliglio-app

## Install

### application scaffolding
	
	composer create-project fliglio/app --dev

### docker

	docker build -t benschw/fl .
	docker run -t -d -p 80 benschw/fl

	
	sudo docker build -t test . && sudo docker kill test && sudo docker rm test  && sudo docker run -t -d -p 80:80 -v /home/ben/dev/fliglio-app/:/var/www/ --name test test

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

	        Options Indexes FollowSymLinks
	        AllowOverride None
	        Order allow,deny
	        Require all granted
	        Allow from all
	    </Directory>
	</VirtualHost>


### Try it out

	curl http://fl.local/api/foo


