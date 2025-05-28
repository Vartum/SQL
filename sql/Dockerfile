FROM php:8.0-apache 
# ↑ Базовый образ
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
# ↑ Выполние команд в контейнере во время сборки образа 
#для установки необходимых зависимостей.
COPY . /var/www/html/
# ↑ Копирование всех файлоа из текущей директории 
#(где находится Dockerfile) в директорию /var/www/html/ (контейнер).