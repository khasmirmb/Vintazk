# Use official PHP 8.3 CLI image
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsodium-dev \
    libpq-dev \
    default-mysql-client \
    default-libmysqlclient-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip sodium \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm (for Vite or frontend assets)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy only necessary files (composer and package files first for caching)
COPY composer.json composer.lock package.json package-lock.json* ./
RUN composer install --no-dev --optimize-autoloader \
    && npm install && npm run build

# Copy the rest of the application
COPY . .

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port (Railway assigns $PORT dynamically)
EXPOSE $PORT

# Run migrations and seed during build (optional, can be moved to Railway deploy)
RUN php artisan migrate --force \
    && php artisan db:seed --class=KpiSeeder --force

# Start the application with PHP-FPM or artisan serve
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$PORT"]
