FROM php:7.4-apache

# Install extensions required for CodeIgniter 3
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    zip unzip \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd mysqli pdo pdo_mysql zip intl xml \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy semua file CodeIgniter ke container
COPY . /var/www/html
RUN rm -rf /var/www/html/*.yml
RUN rm -rf /var/www/html/*Dockerfile

# Enable Apache mod_rewrite (needed for CI clean URLs)
RUN a2enmod rewrite

# Configure Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Optional: set recommended PHP settings for CI3
COPY ./php.ini /usr/local/etc/php/conf.d/ci3.ini

# Konfigurasi Apache agar .htaccess berfungsi
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN echo "PassEnv ENVIRONMENT" >> /etc/apache2/conf-enabled/env.conf
