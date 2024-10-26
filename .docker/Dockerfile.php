FROM php:7.4-fpm-alpine

# Install necessary packages and PHP extensions
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev zlib-dev libzip-dev tidyhtml-dev curl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli zip bcmath gd json tidy curl fileinfo exif

# Install Imagick dependencies and Imagick extension from source
RUN apk add --no-cache autoconf g++ imagemagick imagemagick-dev make \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Menginstal OPcache
RUN docker-php-ext-install opcache



# ioncube loader
RUN curl -fSL 'http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz' -o ioncube.tar.gz \
    && mkdir -p ioncube \
    && tar -xf ioncube.tar.gz -C ioncube --strip-components=1 \
    && rm ioncube.tar.gz \
    && mv ioncube/ioncube_loader_lin_7.4.so /var/www/ioncube_loader_lin_7.4.so \
    && rm -r ioncube

EXPOSE 9000
