# Gunakan base image PHP 8.2 FPM
FROM php:8.2-fpm

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/uts_server

# Salin file proyek ke container
COPY . /var/www/uts_server

# Install dependensi proyek Laravel
RUN composer install --optimize-autoloader --no-dev

# Atur izin untuk folder storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/uts_server \
    && chmod -R 755 /var/www/uts_server/storage \
    && chmod -R 755 /var/www/uts_server/bootstrap/cache

# Ekspos port 8000 untuk php artisan serve
EXPOSE 8000

# Jalankan server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]