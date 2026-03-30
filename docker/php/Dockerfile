FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite asset building)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Increase PHP upload and memory limits
RUN echo "upload_max_filesize = 64M\npost_max_size = 64M\nmemory_limit = 256M" > /usr/local/etc/php/conf.d/uploads.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html

# Check if composer install is needed (it will use the copied composer.json)
# If composer.json exists, install dependencies
RUN if [ -f "composer.json" ]; then composer install --no-interaction --optimize-autoloader --no-dev; fi

# Build frontend assets using Vite
RUN if [ -f "package.json" ]; then npm install && npm run build; fi

# Assign permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
