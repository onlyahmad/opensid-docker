FROM php:7.4-fpm-alpine

# Install necessary packages and PHP extensions
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev zlib-dev libzip-dev tidyhtml-dev curl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli zip bcmath gd json tidy curl fileinfo exif

# Install Imagick dependencies and Imagick extension from source
RUN apk add --no-cache autoconf g++ imagemagick imagemagick-dev make \
    && pecl install imagick \
    && docker-php-ext-enable imagick

EXPOSE 9000
