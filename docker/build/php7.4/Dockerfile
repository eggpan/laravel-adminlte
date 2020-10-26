FROM php:7.4-apache

ENV TZ=Asia/Tokyo

RUN curl https://getcomposer.org/composer-stable.phar -o /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer

RUN apt-get update -y \
 && apt-get install -y --no-install-recommends \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libmagickwand-dev \
      libmemcached-dev \
      libpng-dev \
      libwebp-dev \
      libxpm-dev \
      libzip-dev \
      libonig-dev \
      ssl-cert \
      unzip \
      zip \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install -j$(nproc) bcmath gd gettext intl mysqli opcache pdo_mysql zip
RUN pecl install imagick memcached xdebug \
 && docker-php-ext-enable imagick memcached xdebug

COPY docker-php-entrypoint /usr/local/bin
COPY config/apache2/default.conf /etc/apache2/sites-available
RUN a2dissite 000-default \
 && a2ensite default
RUN a2enmod ssl rewrite
