# Sử dụng PHP 8.2-fpm
FROM php:8.2-fpm

# Cài đặt các phần mở rộng cần thiết
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libpng-dev \
    pkg-config \
    libcurl4-openssl-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài đặt các extension của MongoDB cho PHP
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Cài đặt các gói Composer
WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Sao chép toàn bộ source code của ứng dụng vào container
COPY . .

# Thiết lập quyền cho thư mục lưu cache
RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

# Thiết lập quyền để thư mục làm việc
RUN chmod -R 755 /var/www

# Cài đặt lại các gói Composer
RUN composer dump-autoload --optimize

# Expose cổng 9000 để Nginx truy cập vào PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
