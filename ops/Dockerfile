FROM php:8.2-apache-bookworm

ENV APP_ROOT        "/approot"
ENV DATA_DIR        "/workspace/ops/data"
ENV CONF_DIR        "/workspace/ops/conf"
ENV PHP_INI_DIR     "$CONF_DIR/php"
ENV APACHE_CONFDIR  "$APACHE_DIR/conf"
ENV APACHE_LOCK_DIR "$DATA_DIR/apache/lock"
ENV APACHE_RUN_DIR  "$DATA_DIR/apache/run"
ENV APACHE_LOG_DIR  "$DATA_DIR/apache/logs"
ENV APACHE_ENVVARS  "$APACHE_CONFDIR/envvars"

ENV APACHE_RUN_OWNER "www-data:www-data"

# Backdrop
COPY --from=backdrop:1-apache /var/www/html /approot
RUN chown -R "${APACHE_RUN_OWNER}" /approot;

EXPOSE 80

CMD ["/usr/local/bin/php", "/workspace/ops/entry.php"]

