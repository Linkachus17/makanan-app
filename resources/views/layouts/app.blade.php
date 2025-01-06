<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/checkbox.css')}}">
</head>

<body class="bg-gray-600 flex flex-col items-center p-4">
    <!-- Navigation -->
    @include('layouts.navbar')

    <!-- Main Content -->
    @yield('content')
</body>

</html>