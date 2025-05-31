# Gunakan image PHP-FPM dengan versi PHP yang diinginkan
FROM php:8.4-fpm

# Install dependensi sistem yang diperlukan untuk Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libzip-dev \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install zip

# Set working directory di dalam container
WORKDIR /var/www

# Menyalin file composer ke dalam container dan menginstall dependensi Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependensi PHP melalui Composer
RUN rm composer.lock || true

# Copy entrypoint.sh dan memberikan izin eksekusi
# COPY entrypoint.sh /usr/local/bin/entrypoint.sh
# RUN chmod +x /usr/local/bin/entrypoint.sh

# Menetapkan user yang aman
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# ENTRYPOINT [ "entrypoint.sh" ]

# Menjalankan PHP-FPM
CMD ["php-fpm"]
