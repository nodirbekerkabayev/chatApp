FROM php:8.3-fpm

WORKDIR /var/www

# Zarur paketlar va PHP kengaytmalarini o'rnatish
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxslt-dev \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        gd \
        zip \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Swoole kengaytmasini PECL orqali o'rnatamiz (websocket uchun eng optimal variant)
RUN pecl install swoole \
    && docker-php-ext-enable swoole

# Composer ni qo'shamiz
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ilovani konteynerga ko'chiramiz va composer orqali bog'lanmalarni o'rnatamiz
COPY . /var/www
RUN composer install

# Laravel uchun ilova kalitini generatsiya qilamiz (agar Laravel asosida bo'lsa)
RUN php artisan key:generate
