<!-- resources/views/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-lg font-semibold">Admin Dashboard</h1>
            <!-- Logout Button -->
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="text-white">Logout</button>
            </form>
        </div>
    </nav>



    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-gray-900 h-screen">
            <!-- Sidebar content goes here -->
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-200">
            <!-- Main content goes here -->
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
