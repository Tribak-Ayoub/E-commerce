
# 🚀 **Setting Up Laravel 11 with Vue.js 3 & Breeze for E-Commerce Prototype**

This guide walks you through setting up **Laravel 11**, **Vue.js 3**, and **Breeze** for a simple **E-Commerce** prototype that focuses on CRUD operations for products.

## 📌 **Steps to Set Up Laravel 11 with Vue.js 3 and Breeze**

### 1️⃣ **Install Laravel 11**

If you haven’t already installed Laravel, run the following command to create a new Laravel project:

```bash
composer create-project --prefer-dist laravel/laravel your-project-name "11.*"
cd your-project-name
```

> **Explanation**: This command installs the latest stable version of Laravel 11 and navigates into the project directory.

---

### 2️⃣ **Install Vue.js & Vite**

Since **Laravel 11** uses **Vite** instead of **Laravel Mix** for asset bundling, you need to install **Vue.js** and the **Vite** dependencies.

Run the following command:

```bash
npm install vue@3 @vitejs/plugin-vue
```

> **Explanation**: This installs Vue 3 and the necessary Vite plugin for Vue.

---

### 3️⃣ **Configure Vite for Vue**

Laravel 11 uses **Vite** for frontend asset management. Create or modify the `vite.config.js` file in the root of your Laravel project with the following content:

```js
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
});
```

> **Explanation**: The configuration ensures that **Vite** handles Vue.js and Laravel assets, compiling the necessary files for the frontend.

---

### 4️⃣ **Configure Vue in `resources/js/app.js`**

In `resources/js/app.js`, initialize **Vue** and load your main Vue component:

```js
import { createApp } from 'vue';
import App from './components/App.vue';

createApp(App).mount('#app');
```

> **Explanation**: This script initializes Vue and mounts the **App** component to the `#app` element on the page.

---

### 5️⃣ **Create a Vue Component**

Create the Vue component in `resources/js/components/App.vue`:

```vue
<template>
  <div>
    <h1>Hello from Vue 3 with Laravel 11!</h1>
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

> **Explanation**: This component is a simple Vue component that displays a greeting message.

---

### 6️⃣ **Include Vue in Blade Template**

In `resources/views/welcome.blade.php`, link your Vue.js app:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with Vue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app"></div>
</body>
</html>
```

> **Explanation**: The `@vite` directive ensures that the Vue app is correctly compiled and loaded in the blade template.

---

### 7️⃣ **Install Laravel Breeze (For Authentication)**

To quickly set up authentication with Vue.js, install **Laravel Breeze**. Breeze provides a simple, minimalistic authentication system.

Run the following command:

```bash
composer require laravel/breeze --dev
```

> **Explanation**: This installs **Laravel Breeze** for easy authentication setup.

---

### 8️⃣ **Install Breeze's Vue.js Stubs**

Run this command to install the Vue.js stubs that come with **Breeze**:

```bash
php artisan breeze:install vue
```

> **Explanation**: This command generates Vue.js components for login, registration, and other authentication features.

---

### 9️⃣ **Install NPM Dependencies**

Now install the necessary **npm** packages by running:

```bash
npm install
```

> **Explanation**: This installs all the required dependencies for **Breeze** and **Vue.js** components to work.

---

### 🔟 **Migrate the Database**

Laravel Breeze comes with **default migrations** for user authentication. Run the following command to create the necessary tables:

```bash
php artisan migrate
```

> **Explanation**: This command creates the required database tables for users, password resets, and more.

---

### 1️⃣1️⃣ **Start the Development Servers**

Now, run both the **Laravel** and **Vite** development servers to serve the backend and frontend:

```bash
php artisan serve   # Start the Laravel backend
npm run dev         # Start the Vue.js + Vite frontend
```

> **Explanation**: This will launch both servers. Visit `http://localhost:8000` to see the Vue component rendered and functional.

---

### 1️⃣2️⃣ **Test Authentication**

Now, you can test **authentication** by visiting:

- **Login Page**: `/login`
- **Registration Page**: `/register`
- **Home Page**: `/home` (for authenticated users)

> **Explanation**: These routes are provided by **Breeze**, which allows users to register, login, and reset their passwords.

---

### 1️⃣3️⃣ **Add CRUD for Products**

Now, let’s focus on adding the CRUD functionality for products. Here are the steps:

#### 1️⃣3️⃣1. **Create the Product Model & Migration**

Run the following command to generate a **Product model** with the corresponding **migration**:

```bash
php artisan make:model Product -m
```

In the generated migration file in `database/migrations/`, add fields for the **products** (e.g., name, description, price, etc.):

```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}
```

Run the migration:

```bash
php artisan migrate
```

> **Explanation**: This command creates the **products** table with the necessary fields.

---

#### 1️⃣3️⃣2. **Create Product Controller**

Generate the **ProductController** for handling CRUD operations:

```bash
php artisan make:controller ProductController
```

In the `ProductController`, define methods for **Create**, **Read**, **Update**, and **Delete** operations:

```php
public function index()
{
    return Product::all();
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ]);
    
    return Product::create($validated);
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());
    
    return $product;
}

public function destroy($id)
{
    Product::destroy($id);
    return response()->json(['message' => 'Product deleted successfully']);
}
```

---

#### 3. **Set Up Routes for CRUD**

In `routes/web.php`, define the routes for managing products:

```php
Route::resource('products', ProductController::class);
```

---

#### 4. **Create Vue Components for Product CRUD**

Create Vue components in `resources/js/components/` for handling CRUD operations (e.g., **ProductList.vue**, **ProductForm.vue**, etc.).

In **ProductList.vue**, fetch and display the products:

```vue
<template>
  <div>
    <h1>Product List</h1>
    <ul>
      <li v-for="product in products" :key="product.id">
        {{ product.name }} - {{ product.price }}
        <button @click="deleteProduct(product.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get('/products').then(response => {
        this.products = response.data;
      });
    },
    deleteProduct(id) {
      axios.delete(`/products/${id}`).then(() => {
        this.fetchProducts();
      });
    },
  },
};
</script>
```

---

*****

---

####  **5. Create Add Product Component**
Create `resources/js/views/CreateProduct.vue` to handle product creation:
```vue
<template>
  <div>
    <h1>Add Product</h1>
    <form @submit.prevent="createProduct">
      <input v-model="product.name" placeholder="Name" />
      <input v-model="product.price" placeholder="Price" type="number" />
      <input v-model="product.stock" placeholder="Stock" type="number" />
      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { product: { name: '', price: 0, stock: 0 } };
  },
  methods: {
    async createProduct() {
      await axios.post('/api/products', this.product);
      this.$router.push('/');
    }
  }
};
</script>
```

---

####  **6. Create Edit Product Component**
Create `resources/js/views/EditProduct.vue` to edit product details:
```vue
<template>
  <div>
    <h1>Edit Product</h1>
    <form @submit.prevent="updateProduct">
      <input v-model="product.name" />
      <input v-model="product.price" type="number" />
      <input v-model="product.stock" type="number" />
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { product: {} };
  },
  async created() {
    this.product = (await axios.get(`/api/products/${this.$route.params.id}`)).data;
  },
  methods: {
    async updateProduct() {
      await axios.put(`/api/products/${this.product.id}`, this.product);
      this.$router.push('/');
    }
  }
};
</script>
```