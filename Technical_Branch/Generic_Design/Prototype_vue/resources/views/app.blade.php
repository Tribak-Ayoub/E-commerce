<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css']) {{-- Load Vue app --}}
</head>
<body>
    <div id="app"></div> {{-- Vue will mount here --}}
</body>
</html>
