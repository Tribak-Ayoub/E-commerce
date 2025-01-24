## Install Spatie Permission
composer require spatie/laravel-permission

## Publish migration and config
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

## install AdminLTE using npm
npm install admin-lte@3.2.0

 php artisan make:migration create_products_table

php artisan make:controller ProductController --resource --model=Product

 php artisan make:request ProductRequest

 php artisan make:factory ProductFactory

 php artisan make:seeder ProductSeeder

 npm install jquery bootbox

 npm install admin-lte alpinejs jquery bootbox