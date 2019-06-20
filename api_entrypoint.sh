#!/bin/bash
# Change access rights for the Laravel folders
# in order to make Laravel able to access 
# cache and logs folder.
chmod -R 775 /var/www/html/
chown -R www-data:www-data /var/www/html/
chgrp -R www-data storage bootstrap/cache && \
chown -R www-data storage bootstrap/cache && \
chmod -R ug+rwx storage bootstrap/cache && \
# Create log file for Laravel and give it write access
# www-data is a standard apache user that must have an
# access to the folder structure
touch storage/logs/laravel.log && chmod 775 storage/logs/laravel.log && chown www-data storage/logs/laravel.log
composer install  
npm install 
php artisan migrate --env=yes
php artisan get:Data
php artisan get:Tripavisor
php artisan cache:clear
php artisan config:clear 
echo "Deployment ok"
/usr/sbin/apache2ctl -D FOREGROUND
