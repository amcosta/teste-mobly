FROM nanoninja/php-fpm:latest
MAINTAINER Alex Moreno <alex.moreno.costa@gmail.com>
RUN chown www-data:www-data -R /var/www
USER www-data
WORKDIR /var/www/html
EXPOSE 9000
