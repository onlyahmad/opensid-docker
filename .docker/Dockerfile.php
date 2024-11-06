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

# Menambahkan konfigurasi OPcache di php.ini
# RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
#     echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini


# ioncube loader
# RUN curl -fSL 'http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz' -o ioncube.tar.gz \
#     && mkdir -p ioncube \
#     && tar -xf ioncube.tar.gz -C ioncube --strip-components=1 \
#     && rm ioncube.tar.gz \
#     && mv ioncube/ioncube_loader_lin_7.4.so /var/www/ioncube_loader_lin_7.4.so \
#     && rm -r ioncube

# Install ionCube
RUN curl -SL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz | tar -xz \
    && mv ioncube/ioncube_loader_lin_7.4.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/ \
    && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20190902/ioncube_loader_lin_7.4.so" > /usr/local/etc/php/conf.d/00-ioncube.ini

# Configure opcache
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.revalidate_freq=60" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

EXPOSE 9000