FROM backdrop:1-apache

# Install xdebug
RUN yes | pecl install xdebug; rm -rf /tmp/pear

COPY . /workspace/

COPY ops/bin/info.php /var/www/html/info.php
COPY ops/config/php /usr/local/etc/php
COPY ops/config/apache2 /etc/apache2

WORKDIR /var/www/html
RUN rm -rf modules layouts profiles sites themes
RUN ln -s /workspace/src/* ./
RUN chown -R www-data:www-data /var/www/html

# RUN wget -O - https://github.com/potsky/PimpMyLog/tarball/master | tar xzf - && mv potsky-PimpMyLog-* PimpMyLog

CMD ["/usr/local/bin/php", "/workspace/ops/bin/entry.php"]

