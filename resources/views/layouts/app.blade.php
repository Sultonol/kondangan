<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wedding Invitation')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 font-inter">
    @yield('content')
</body>
</html>