# Sử dụng PHP 8.2
FROM php:8.2-fpm

# Cài đặt các dependency cần thiết bao gồm SSL và các extension
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install pdo mbstring exif pcntl bcmath gd

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài đặt MongoDB extension với SSL
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Cài đặt MongoDB driver cho Laravel
RUN composer require jenssegers/mongodb

# Thiết lập thư mục làm việc cho ứng dụng Laravel
WORKDIR /var/www

# Copy mã nguồn Laravel vào container
COPY . .

# Cài đặt các dependency của Laravel qua Composer
RUN composer install

# Thiết lập quyền cho các thư mục Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port 9000 để kết nối với Nginx
EXPOSE 9000

CMD ["php-fpm"]
