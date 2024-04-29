<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Admin </title>

    <head>
        <title>Admin</title>
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
    @if (Session::has('message'))
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-indigo-600" x-data="{ open: true }" x-show="open">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-indigo-800">
                            <!-- Heroicon name: outline/speakerphone -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </span>
                        <p class="ml-3 font-medium text-white truncate">
                            <span class="md:hidden"> {{ Session::get('message') }} </span>
                            <span class="hidden md:inline"> {{ Session::get('message') }} </span>
                        </p>
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button @click="open = false" type="button"
                            class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-blue-400 text-gray-200 w-64">
            <div class="p-4 border-b border-white-700">
                <img src="{{ asset('dict-logo.png') }}" alt="DICT Logo" class="h-9 w-auto mx-auto">
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.index') }}"
                class="flex items-center text-sm py-2 px-4
                       {{ request()->routeIs('admin.index') ? 'bg-gray-700 text-white' : 'text-gray-200' }}
                       hover:bg-gray-700">
                 <i class="fas fa-tachometer-alt mr-2"></i> <!-- Dashboard Icon -->
                 Dashboard
             </a>
             <a href="{{ route('admin.users.index') }}"
                class="flex items-center text-sm py-2 px-4
                       {{ request()->routeIs('admin.users.index') ? 'bg-gray-700 text-white' : 'text-gray-200' }}
                       hover:bg-gray-700">
                 <i class="fas fa-users mr-2"></i> <!-- Users Icon -->
                 Users
             </a>
             <a href="{{ route('doctrack.index') }}"
                class="flex items-center text-sm py-2 px-4
                       {{ request()->routeIs('doctrack.index') ? 'bg-gray-700 text-white' : 'text-gray-200' }}
                       hover:bg-gray-700">
                 <i class="fas fa-file-alt mr-2"></i> <!-- Document Tracking Icon -->
                 Document Tracking
             </a>
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
