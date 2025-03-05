# Create new Laravel project
laravel new watches-ecommerce

# Install Breeze with Vue
composer require laravel/breeze --dev
php artisan breeze:install vue

# Install dependencies
npm install
npm install vue-router@4 @headlessui/vue @heroicons/vue
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Remove Inertia.js (If Installed)
npm remove @inertiajs/vue3
