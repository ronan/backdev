FROM backdrop:1-apache

COPY . /workspace/

COPY ops/bin/info.php /var/www/html/info.php
COPY ops/conf/php /usr/local/etc/php
COPY ops/conf/apache2 /etc/apache2

WORKDIR /var/www/html
RUN rm -rf modules layouts profiles sites themes
RUN ln -s /workspace/src/* ./
RUN chown -R www-data:www-data /var/www/html

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear


CMD ["/usr/local/bin/php", "/workspace/ops/bin/entry.php"]

