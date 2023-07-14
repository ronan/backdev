FROM mcr.microsoft.com/devcontainers/php:0-8.2

# Mod reqwrite
RUN a2enmod rewrite

# PHP extensions
RUN apt-get update 
RUN apt-get install -y --no-install-recommends libzip-dev libonig-dev libpng-dev libjpeg-dev libpq-dev
RUN rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-jpeg=/usr
RUN docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /workspace

# Backdrop
RUN rm -rf /var/www/html
COPY --from=backdrop:1-apache /var/www/html /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Drush & Backdrop extension
RUN composer require drush/drush:8.x
# RUN wget https://github.com/backdrop-contrib/backdrop-drush-extension/releases/download/1.4.0/backdrop-drush-extension.zip
# RUN unzip backdrop-drush-extension.zip -d vendor/drush/drush/commands/backdrop
# RUN ln -s /workspace/vendor/bin/drush /usr/bin/drush
# RUN rm *.zip

# WORKDIR /var/www/html
# RUN ../vendor/bin/drush si --db-url="mysql://user:pass@db/backdrop" -y 

CMD ["apache2-foreground"]