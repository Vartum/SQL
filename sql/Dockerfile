FROM php:8.0-apache
# Устанавливаем зависимости
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
COPY . /var/www/html/