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

# --- OPTIMIZED DEPENDENCY INSTALLATION ---
# Install build dependencies as a "virtual" package, compile the extension,
# then remove the virtual package in the same step.
RUN apk add --no-cache nginx \
    && apk add --no-cache --virtual .build-deps sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && apk del .build-deps
# --- END OPTIMIZATION ---

# Copy the built application from the builder stage
COPY --from=builder /app .

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Create and set permissions for Nginx log/pid directories and Laravel storage
RUN mkdir -p /run/nginx /var/log/nginx \
    && chown -R www-data:www-data /var/log/nginx /run/nginx \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx and PHP-FPM
CMD sh -c "php-fpm & nginx -g 'daemon off;'"