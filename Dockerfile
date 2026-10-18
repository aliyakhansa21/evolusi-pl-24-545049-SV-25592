# Mulai dari image resmi PHP 8.3 versi CLI yang ringan
FROM php:8.3-cli-alpine

# Install ekstensi sistem yang dibutuhkan untuk database (menyesuaikan penggunaan SQLite/MySQL)
RUN apk add --no-cache unzip sqlite-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tentukan folder kerja di dalam container
WORKDIR /var/www

# URUTAN BENAR: Salin daftar dependensi DULU agar layer ini bisa di-cache
COPY composer.json composer.lock ./

# Jalankan instalasi dependensi
RUN composer install --no-dev --no-scripts

# Baru salin sisa kodenya (layer ini yang akan sering berubah jika kamu mengedit kode)
COPY . .

# Catatan port yang akan digunakan
EXPOSE 8000

# Perintah yang dijalankan saat container nyala menggunakan built-in server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]