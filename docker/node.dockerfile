FROM node:latest
MAINTAINER Alex Moreno <alex.moreno.costa@gmail.com>
RUN mkdir -p /var/www/html
RUN chown -R www-data:www-data /var/www