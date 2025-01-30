<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Sidebar -->
        @include('layouts.adminlte.aside')
        
        <!-- Navbar -->
        @include('layouts.adminlte.nav')
        

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

           <!-- Footer -->
           @include('layouts.adminlte.footer')

</body>
</html>
