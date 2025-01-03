# Backend Dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --prefer-dist --no-dev --no-progress --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
