# Jalankan perintah ini untuk update dengan versi yang dioptimasi

# 1. Hapus data lama
php artisan migrate:fresh

# 2. Jalankan seeder baru yang sudah dioptimasi
php artisan db:seed

# 3. Pastikan storage link sudah ada
php artisan storage:link

# 4. Clear cache untuk performa optimal
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# 5. Cek apakah file sudah ada
ls -la storage/app/public/events/videos/
ls -la storage/app/public/events/images/

# 6. Set permission yang optimal
chmod -R 755 storage/
chmod -R 755 public/storage/
