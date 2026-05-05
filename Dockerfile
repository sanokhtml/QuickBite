FROM php:8.2-fpm-alpine

# Встановлення системних залежностей
RUN apk update && apk add --no-cache \
    nginx \
    shadow \
    libxml2-dev \
    sqlite-dev \
    nodejs \
    npm \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

# Встановлення PHP розширень (додали gd та exif)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite bcmath xml gd exif

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копіюємо файли проекту
COPY . .

# Встановлення PHP та JS залежностей
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Налаштування прав доступу для SQLite та папок Laravel
RUN touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Налаштування Nginx
COPY .docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD php artisan migrate --force && php-fpm -D && nginx -g "daemon off;"