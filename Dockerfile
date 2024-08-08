# Use an official PHP image with Apache as the base image.
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Enable Apache modules required for Laravel.
RUN a2enmod rewrite

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update the default Apache site configuration
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install additional PHP extensions
RUN docker-php-ext-install bcmath ctype json tokenizer xml

# Install Composer globally.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a directory for your Laravel application.
WORKDIR /var/www/html

# Copy the Laravel application files into the container.
COPY . .

# Install Laravel dependencies using Composer.
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permissions for Laravel.
RUN chown -R www-data:www-data storage bootstrap/cache

# Set up environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose port 80 for Apache.
EXPOSE 80

# Start Apache web server.
CMD ["apache2-foreground"]
