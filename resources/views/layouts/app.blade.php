<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Al-Fatih Center - Pusat Tumbuh Kembang Anak dengan berbagai layanan terapi profesional">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Al-Fatih Center')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- CSS -->
    @vite('resources/css/app.css')
    
    <!-- Additional styles -->
    @stack('styles')
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Include the existing navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    
    @stack('scripts')
</body>
</html>