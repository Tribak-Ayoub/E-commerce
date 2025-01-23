## Install Spatie Permission
composer require spatie/laravel-permission

## Publish migration and config
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

npm install admin-lte@3.2.0