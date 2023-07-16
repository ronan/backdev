FROM php:8.2-apache-bookworm

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear

# Install composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

# [Optional] Uncomment this section to install additional packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# Mod reqwrite
RUN a2enmod rewrite

# PHP extensions
RUN apt-get update 
RUN apt-get install -y --no-install-recommends libzip-dev libonig-dev libpng-dev libjpeg-dev libpq-dev
RUN rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-jpeg=/usr
RUN docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql zip


WORKDIR /workspace

# Backdrop
RUN rm -rf /var/www/html
COPY --from=backdrop:1-apache /var/www/html /var/www/html
RUN chown -R www-data:www-data /var/www/html

CMD ["php", "/workspace/ops/entry.php"]

