
composer create-project --prefer-dist laravel/laravel watches-ecommerce

cd watches-ecommerce

composer require laravel/breeze --dev

php artisan breeze:install

 php artisan migrate    

 npm install vue@3 vue-router@4 @vitejs/plugin-vue

npm install

npm install axios

php artisan make:model Product -mfs
php artisan make:model ProductImage -mfs
php artisan make:model Order -mfs
php artisan make:model OrderItem -mfs
php artisan make:model Payment -mfs
php artisan make:model Review -mfs
