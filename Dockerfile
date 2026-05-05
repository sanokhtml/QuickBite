FROM php:8.2-fpm-alpine

# Встановлення системних залежностей (тільки найнеобхідніше для SQLite та Nginx)
RUN apk update && apk add --no-cache \
    nginx \
    shadow \
    libxml2-dev \
    sqlite-dev \
    nodejs \
    npm

# Встановлення PHP розширень (без зайвих конфігурацій GD)
RUN docker-php-ext-install pdo pdo_sqlite bcmath xml

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копіюємо файли проекту
COPY . .

# Встановлення залежностей (додали прапорець --ignore-platform-reqs)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN npm install && npm run build

# Налаштування права доступу
RUN touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Налаштування Nginx
COPY .docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD php artisan migrate:fresh --seed --force && php-fpm -D && nginx -g "daemon off;"