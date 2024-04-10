<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!--DATATABLES.NET Add inside the <head> tag in resources/views/layouts/app.blade.php -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    
    {{-- AJAX FOR CSRF_TOKEN--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- Add before the DataTables script in resources/views/layouts/app.blade.php -->
    {{-- DataTables requires jQuery. If you haven't already included jQuery in your layout file, add it before the DataTables script: --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!--DATATABLE SCRIPT FROM INDEX.BLADE Add before the closing </body> tag in resources/views/layouts/app.blade.php -->
    @yield('scripts')

    <!--DATATABLES.NET Add before the closing </body> tag in resources/views/layouts/app.blade.php -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    {{-- AJAX INSERTING DATA--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    {{-- CALLING SCRIPT FOR DATATABLE --}}
    @stack('scripts')
</body>
</html>