FROM ubuntu:14.04

MAINTAINER Ben Schwartz, https://github.com/fliglio

RUN apt-get update

RUN apt-get install -y apache2 php5

RUN a2enmod php5
RUN a2enmod rewrite

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid


EXPOSE 80

ADD ./ /var/www/

ADD apache-vhost.conf /etc/apache2/sites-enabled/000-default.conf



# Launch apache when launching the container

ENTRYPOINT ["/usr/sbin/apache2ctl"]
CMD ["-D", "FOREGROUND"]
