#!/bin/sh

echo "Running ---> composer install..."
composer install && \

echo "Running ---> chmod -R 777 /var/www"
chmod -R 777 /var/www && \
chmod -R 777 /var/www* &&\

echo "Running ---> php-fpm"
php-fpm

