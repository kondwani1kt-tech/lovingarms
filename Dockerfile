FROM php:8.3-apache

RUN apt-get update \
  && apt-get install -y --no-install-recommends git unzip libzip-dev libpq-dev ca-certificates \
  && docker-php-ext-install pdo_pgsql pgsql zip bcmath \
 && a2enmod rewrite headers \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/laravel.conf \
 && a2enconf laravel

WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod +x docker/start.sh

# CMD (not ENTRYPOINT) so Render's cron service can override it with `php artisan report:weekly`.
CMD ["docker/start.sh"]
