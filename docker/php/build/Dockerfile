FROM php:8.2-fpm

# Встановлюємо змінні середовища
ENV DEBIAN_FRONTEND noninteractive

# --- СИСТЕМНІ ЗАЛЕЖНОСТІ ---
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            git \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev \
            libicu-dev \
            zlib1g-dev \
            # --- FIX: Додаємо libzip-dev для компіляції PHP-розширення 'zip' ---
            libzip-dev \
            unzip; \
    rm -rf /var/lib/apt/lists/*

# --- КОНФІГУРАЦІЯ PHP ---
RUN echo "short_open_tag = Off" >> /usr/local/etc/php/php.ini

# --- PHP-РОЗШИРЕННЯ ---
RUN set -eux; \
    # Встановлення основних розширень
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-install pdo_pgsql; \
    docker-php-ext-install intl; \
    # Успішне встановлення zip завдяки libzip-dev
    docker-php-ext-install zip; \
    \
    # Конфігурація та встановлення GD
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

# --- COMPOSER ---
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# --- OPCACHE ---
RUN docker-php-ext-install opcache
RUN echo "opcache.enable = 1" >> /usr/local/etc/php/php.ini

# --- SYMFONY CLI ---
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# --- РОБОЧА ДИРЕКТОРІЯ ---
WORKDIR /app