<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Watch Store</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="text-xl font-semibold">
                            <a href="/">Watch Store</a>
                        </div>

                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6">
                        <!-- Hero Section -->
                        <section class="bg-white dark:bg-gray-800 py-20">
                            <div class="container mx-auto px-6 text-center">
                                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                                    Discover the Perfect Watch
                                </h1>
                                <p class="text-gray-600 dark:text-gray-300 mb-8">
                                    Explore our exclusive collection of luxury and casual watches.
                                </p>
                                <a
                                    href="{{route('products.index')}}"
                                    class="bg-[#FF2D20] text-white px-6 py-3 rounded-lg hover:bg-[#FF2D20]/90 transition duration-300"
                                >
                                    Shop Now
                                </a>
                            </div>
                        </section>

                        <!-- Featured Products Section -->
                        {{-- <section id="featured" class="py-16">
                            <div class="container mx-auto px-6">
                                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8 text-center">
                                    Featured Watches
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Product Card 1 -->
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                                        <img src="https://via.placeholder.com/300" alt="Watch 1" class="w-full h-48 object-cover mb-4 rounded-lg">
                                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Classic Watch</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                                            A timeless classic for every occasion.
                                        </p>
                                        <p class="text-2xl font-bold text-gray-800 dark:text-white">$199.99</p>
                                        <button class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg mt-4 w-full hover:bg-[#FF2D20]/90 transition duration-300">
                                            Add to Cart
                                        </button>
                                    </div>

                                    <!-- Product Card 2 -->
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                                        <img src="https://via.placeholder.com/300" alt="Watch 2" class="w-full h-48 object-cover mb-4 rounded-lg">
                                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Sport Watch</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                                            Perfect for your active lifestyle.
                                        </p>
                                        <p class="text-2xl font-bold text-gray-800 dark:text-white">$149.99</p>
                                        <button class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg mt-4 w-full hover:bg-[#FF2D20]/90 transition duration-300">
                                            Add to Cart
                                        </button>
                                    </div>

                                    <!-- Product Card 3 -->
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                                        <img src="https://via.placeholder.com/300" alt="Watch 3" class="w-full h-48 object-cover mb-4 rounded-lg">
                                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Luxury Watch</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                                            Elegance and sophistication in every detail.
                                        </p>
                                        <p class="text-2xl font-bold text-gray-800 dark:text-white">$499.99</p>
                                        <button class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg mt-4 w-full hover:bg-[#FF2D20]/90 transition duration-300">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
                    </main>

                    <!-- Footer -->
                    <footer class="bg-white dark:bg-gray-800 py-10 mt-20">
                        <div class="container mx-auto px-6 text-center">
                            <p class="text-gray-600 dark:text-gray-300">
                                &copy; 2023 Watch Store. All rights reserved.
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>