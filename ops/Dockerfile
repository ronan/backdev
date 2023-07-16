FROM alpine:3.14

ENV DATA_DIR /workspace/ops/data
ENV PHP_INI_DIR "$DATA_DIR/php"
ENV APACHE_LOCK_DIR "$DATA_DIR/apache/lock"
ENV APACHE_RUN_DIR "$DATA_DIR/apache/run"
ENV APACHE_LOG_DIR "$DATA_DIR/apache/logs"
ENV APACHE_CONFDIR "$DATA_DIR/apache/conf"
ENV APACHE_ENVVARS "$APACHE_CONFDIR/envvars"

ENV APACHE_RUN_USER "www-data"
ENV APACHE_RUN_GROUP "www-data"
ENV APACHE_RUN_OWNER "$APACHE_RUN_USER:$APACHE_RUN_GROUP"

RUN set -eux; \
	{ \
		echo 'Package: php*'; \
		echo 'Pin: release *'; \
		echo 'Pin-Priority: -1'; \
	} > /etc/apt/preferences.d/no-debian-php

RUN set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
		ca-certificates \
		curl \
		xz-utils \
		autoconf \
		dpkg-dev \
		file \
		g++ \
		gcc \
		libc-dev \
		make \
		pkg-config \
		re2c \
	; \
	rm -rf /var/lib/apt/lists/*

# PHP config
RUN set -eux; \
	mkdir -p "$PHP_INI_DIR/conf.d"; \
	mkdir -p /approot; \
	chown $APACHE_RUN_OWNER /approot; \
	chmod 1777 /approot

RUN set -eux; \
	apt-get update; apt-get install -y apache2; \
	rm -rf /var/lib/apt/lists/*;

# COPY --from=php:8.2-bookworm 

RUN	for dir in \
		"$APACHE_LOCK_DIR" \
		"$APACHE_RUN_DIR" \
		"$APACHE_LOG_DIR" \
	; do \
		rm -rvf $dir; \
		mkdir -p $dir; \
		chown $APACHE_RUN_OWNER $dir; \
		chmod 1777 $dir; \
	done; \
	rm -rvf /approot/*; \
	\
# logs should go to stdout / stderr
	ln -sfT /dev/stderr "$APACHE_LOG_DIR/error.log"; \
	ln -sfT /dev/stdout "$APACHE_LOG_DIR/access.log"; \
	ln -sfT /dev/stdout "$APACHE_LOG_DIR/other_vhosts_access.log"; \
	chown -R --no-dereference "$APACHE_RUN_OWNER" "$APACHE_LOG_DIR"

# PHP files should be handled by PHP, and should be preferred over any other file type
RUN { \
		echo '<FilesMatch \.php$>'; \
		echo '\tSetHandler application/x-httpd-php'; \
		echo '</FilesMatch>'; \
		echo; \
		echo 'DirectoryIndex disabled'; \
		echo 'DirectoryIndex index.php index.html'; \
		echo; \
		echo '<Directory /approot/>'; \
		echo '\tOptions -Indexes'; \
		echo '\tAllowOverride All'; \
		echo '</Directory>'; \
	} | tee "$APACHE_CONFDIR/conf-available/docker-php.conf" \
	&& a2enconf docker-php


# Xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear



# Composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

# PHP extensions
# RUN apt-get update 
# RUN apt-get install -y --no-install-recommends libzip-dev libonig-dev libpng-dev libjpeg-dev libpq-dev
# RUN rm -rf /var/lib/apt/lists/*
# RUN docker-php-ext-configure gd --with-jpeg=/usr
# RUN docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql zip

WORKDIR /workspace

# Backdrop
RUN rm -rf /var/www/html
COPY --from=backdrop:1-apache /var/www/html /var/www/html
RUN chown -R "${APACHE_RUN_OWNER}" /var/www/html

EXPOSE 80

CMD ["php", "/workspace/ops/entry.php"]

