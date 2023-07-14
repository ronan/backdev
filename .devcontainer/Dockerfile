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
RUN wget https://github.com/backdrop/backdrop/releases/download/1.25.1/backdrop.zip
RUN unzip backdrop.zip
RUN ln -s /workspace/backdrop /var/www/html

# Drush & Backdrop extension
RUN composer require drush/drush:8.x
RUN wget https://github.com/backdrop-contrib/backdrop-drush-extension/releases/download/1.4.0/backdrop-drush-extension.zip
RUN unzip backdrop-drush-extension.zip -d vendor/drush/drush/commands/backdrop
RUN ln -s /workspace/vendor/bin/drush /usr/bin/drush
# COPY .devcontainer/drush.yml /etc/drush/drush.yml

# RUN mv /var/www/backdrop /var/www/html

RUN rm *.zip

# WORKDIR /var/www/html
# RUN ../vendor/bin/drush si --db-url="mysql://user:pass@db/backdrop" -y 
# RUN chown -R www-data:www-data html

CMD ["apache2-foreground"]