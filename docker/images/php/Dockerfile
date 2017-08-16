FROM php:7.1.0-fpm-alpine

# Install PHP extensions
RUN apk --update add --no-cache --virtual .build-deps \
    autoconf \
    build-base && \
    apk add --no-cache \
    libmcrypt-dev \
    zlib-dev \
    bzip2-dev &&\
    docker-php-ext-install bcmath mcrypt zip bz2 && \
    apk del .build-deps

# Install composer dependencies
RUN apk add --no-cache  \
    curl \
    vim \
    git \
    libbz2 \
    subversion \
    openssh \
    openssl

# Logger dependencies
RUN mkdir /var/log/slim && touch /var/log/slim/bootstrap.log && chmod -R 777 /var/log/slim/

# Composer version to install
ENV COMPOSER_VERSION 1.3.2

# Set composer home (for cache)
ENV COMPOSER_HOME /root/composer

# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Add composer global packages to path
ENV PATH /root/composer/vendor/bin:$PATH

# Install Composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1);  }" \
  && php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} && rm -rf /tmp/composer-setup.php

WORKDIR /var/www/bootstrap
