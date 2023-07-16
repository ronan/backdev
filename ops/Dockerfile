FROM backdrop:1-apache

# Install xdebug
RUN yes | pecl install xdebug; rm -rf /tmp/pear

COPY . /workspace/

COPY ops/bin/info.php /var/www/html/info.php
COPY ops/conf/php /usr/local/etc/php
COPY ops/conf/apache2 /etc/apache2

WORKDIR /var/www/html
RUN rm -rf modules layouts profiles sites themes
RUN ln -s /workspace/src/* ./
RUN chown -R www-data:www-data /var/www/html

CMD ["/usr/local/bin/php", "/workspace/ops/bin/entry.php"]

