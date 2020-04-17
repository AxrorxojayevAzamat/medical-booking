FROM hermsi/alpine-fpm-php:7.2.28

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require hirak/prestissimo

EXPOSE 9000
CMD ["php-fpm", "-F"]
