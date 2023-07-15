FROM mcr.microsoft.com/devcontainers/php:0-8.2

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

CMD ["apache2-foreground"]