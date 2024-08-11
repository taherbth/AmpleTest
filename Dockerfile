FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    libonig-dev \ 
    git 


# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Configure and install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install -j$(nproc) gd || (cat /tmp/config.log && exit 1)

# Install pdo_mysql
RUN docker-php-ext-install -j$(nproc) pdo_mysql

# Install mbstring
RUN docker-php-ext-install -j$(nproc) mbstring

# Install exif
RUN docker-php-ext-install -j$(nproc) exif

# Install pcntl
RUN docker-php-ext-install -j$(nproc) pcntl

# Install bcmath
RUN docker-php-ext-install -j$(nproc) bcmath

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copy application code
COPY . /var/www

# Set working directory
WORKDIR /var/www

# Install PHP dependencies
RUN composer install

# Install npm dependencies
RUN npm install

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis
RUN composer require predis/predis

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
