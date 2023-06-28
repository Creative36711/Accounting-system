FROM php:7.1-apache
WORKDIR /var/www/html
COPY . /var/www/html
EXPOSE 80