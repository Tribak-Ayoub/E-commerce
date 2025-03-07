<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script>
        // localStorage.setItem('loggedIn', {{ auth()->check() ? 'true' : 'false' }});
    </script>
</body>
</html>