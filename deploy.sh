#!/usr/bin/env bash
set -e

echo "Langkah 1: Backup rilis aplikasi saat ini"
echo "Langkah 2: Mengambil kode terbaru dari branch main"
echo "Langkah 3: Instal dependensi produksi (composer install --no-dev --optimize-autoloader)"
echo "Langkah 4: Menjalankan migrasi database (php artisan migrate --force)"
echo "Langkah 5: Membangun cache konfigurasi, route, dan view"
echo "Langkah 6: Merestart layanan aplikasi (php-fpm, queue worker)"
echo "Langkah 7: Menjalankan health check pasca-deploy"

echo "Simulasi deployment ke production selesai."
