# ==========================================
# STAGE 1: Builder (Tahap Membangun)
# Boleh besar, menginstall composer dan dependencies
# ==========================================
FROM php:8.3-cli-alpine AS builder

# Install ekstensi zip & pdo untuk composer dan database
RUN apk add --no-cache zip unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy file composer untuk caching layer
COPY composer.json composer.lock ./

# Install dependensi Laravel (tanpa dev dependencies)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy sisa source code
COPY . .

# ==========================================
# STAGE 2: Runner (Tahap Menjalankan)
# Kecil, aman (non-root), dan ada healthcheck
# ==========================================
FROM php:8.3-cli-alpine

# Install ekstensi PHP yang dibutuhkan aplikasi saat runtime
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

# Buat non-root user bernama 'laravel' (Syarat keamanan)
RUN adduser -D -u 1000 laravel

# Copy HANYA file yang sudah jadi dari stage builder
# Sekaligus mengubah kepemilikannya ke user 'laravel'
COPY --from=builder --chown=laravel:laravel /app /app

# Ganti user dari root ke non-root 'laravel'
USER laravel

EXPOSE 8000

# Syarat Healthcheck: Menggunakan wget bawaan alpine
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD wget --no-verbose --tries=1 --spider http://localhost:8000/ || exit 1

# Jalankan aplikasi
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]