# Laravel 11 with Vue.js 3 Setup

This guide will help you set up a Laravel 11 project with Vue.js 3 to build modern web applications.

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm

## Steps

### 1. **Install Laravel 11**
If you haven't already, create a new Laravel 11 project by running the following command:

```bash
composer create-project --prefer-dist laravel/laravel your-project-name "11.*"
```

### 2. **Install Node.js and npm**
Ensure that you have Node.js and npm installed. You can download and install them from the [Node.js website](https://nodejs.org/).

### 3. **Install Vue.js**
Navigate to your Laravel project directory and install Vue.js and other required packages via npm:

```bash
cd your-project-name
npm install vue@3 vue-loader@next
```

### 4. **Set up Laravel Mix**
Laravel uses Laravel Mix to compile assets. Open the `webpack.mix.js` file in the root of your project and configure it to compile Vue files:

```js
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue()
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ]);
```

### 5. **Configure Vue in `resources/js/app.js`**
In the `resources/js/app.js` file, create a Vue instance:

```js
import { createApp } from 'vue';
import App from './components/App.vue';

createApp(App).mount('#app');
```

### 6. **Create Vue Component**
Create a simple Vue component in `resources/js/components` (e.g., `App.vue`):

```vue
<template>
  <div>
    <h1>Hello from Vue 3!</h1>
  </div>
</template>

<script>
export default {
  name: 'App',
}
</script>

<style scoped>
h1 {
  color: #42b983;
}
</style>
```

### 7. **Run Laravel Mix**
Now, compile your assets by running the following command:

```bash
npm run dev
```

### 8. **Include Vue in Blade View**
In your Blade template (`resources/views/welcome.blade.php`), include the compiled `app.js`:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with Vue</title>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app"></div>
</body>
</html>
```

### 9. **Start Development Server**
Finally, start your Laravel development server:

```bash
php artisan serve
```

Now, navigate to `http://localhost:8000` in your browser, and you should see your Vue component rendered.
