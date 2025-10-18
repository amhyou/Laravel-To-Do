# ---- Builder Stage ----
FROM composer:2 as builder
WORKDIR /app
RUN apk add --no-cache nodejs npm
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --no-dev --prefer-dist --optimize-autoloader
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# ---- Final Stage ----
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Install extensions
RUN apk add --no-cache nginx \
    && apk add --no-cache --virtual .build-deps sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && apk del .build-deps

# Copy application and config
COPY --from=builder /app .
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Assign ownership of Laravel's writable directories to root.
# Nginx (running as root) already has permission to create its own files.
RUN chown -R root:root /var/www/html/storage /var/www/html/bootstrap/cache \
    && touch /var/www/html/database/database.sqlite \
    && chown root:root /var/www/html/database/database.sqlite

EXPOSE 80
CMD sh -c "php-fpm & nginx -g 'daemon off;'"