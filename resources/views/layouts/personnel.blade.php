<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <title>Documentation Tracking</title>
    <head>
        <title>Documentation Tracking</title>
    </head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside class="bg-blue-400 text-gray-200 w-64">
                <div class="p-4 border-b border-white-700">
                    <img src="{{ asset('dict-logo.png') }}" alt="DICT Logo" class="h-9 w-auto mx-auto">
                </div>
                <nav class="mt-4">
                  
                 <a href="{{ route('personnel.document') }}"
                    class="flex items-center text-sm py-2 px-4
                           {{ request()->routeIs('personnel.document') ? 'bg-gray-700 text-white' : 'text-gray-200' }}
                           hover:bg-gray-700">
                     <i class="fas fa-file mr-2"></i> <!-- Document Icon -->
                     Personnel Document
                 </a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf <!-- CSRF Protection -->
                    </form>
                    <a href="#" onclick="event.preventDefault(); confirmLogout();"
           class="flex items-center text-sm py-2 px-4 hover:bg-gray-700">
            <i class="fas fa-sign-out-alt mr-2"></i> <!-- Logout Icon -->
            Logout
        </a>

                </nav>

            </aside>

            <!-- Page Content -->
            <main class="bg-white flex-1 p-4">
                {{ $slot }}
            </main>
        </div>
        <script>
            function confirmLogout() {
                if (confirm('Are you sure you want to logout?')) {
                    document.getElementById('logoutForm').submit(); // Submit the hidden form
                }
            }
        </script>
    </body>
</html>
