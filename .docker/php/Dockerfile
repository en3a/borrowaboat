FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim  \
    optipng  \
    pngquant  \
    gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    zip \
    libpng-dev \
    libxml2-dev \
    wget \
    nano \
    supervisor \
    cron && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring bcmath opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

# Create www user
RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www

# Copy PHP config files before app code
COPY .docker/php/opcache-prod.ini /usr/local/etc/php/conf.d/opcache.ini
COPY .docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy application code and set permissions
COPY --chown=www:www . /var/www

# Ensure logs directory exists
RUN mkdir -p /var/log/php && chown -R www:www /var/log/php

# Entrypoint
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Switch to non-root user
USER www

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 9000