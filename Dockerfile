# Use official PHP 8.3 FPM image
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

# Copy composer files first for caching
COPY composer.json composer.lock ./

# Install PHP dependencies, skipping scripts to avoid package:discover
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy the rest of the application
COPY . .

# Generate .env file and APP_KEY
RUN php -r "file_exists('.env') || copy('.env.example', '.env');" \
    && php artisan key:generate --force

# Install JS dependencies (if needed)
RUN [ -f "package.json" ] && npm install && npm run build || true

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run package:discover explicitly after setup
RUN php artisan package:discover --ansi

# Expose port (Railway assigns $PORT dynamically)
EXPOSE $PORT

# Start the application with verbose debugging, skipping migrations for testing
CMD ["sh", "-c", "echo 'Environment: APP_ENV=$APP_ENV, DATABASE_URL=$DATABASE_URL' && echo 'Testing PHP...' && php -v && echo 'Testing Artisan...' && php artisan --version && echo 'Testing DB connection...' && php artisan migrate:status --verbose || { echo 'DB connection failed'; exit 1; } && echo 'Starting server...' && php artisan serve --host=0.0.0.0 --port=$PORT"]
