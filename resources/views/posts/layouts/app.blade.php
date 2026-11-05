<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen hidden md:block">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <p class="text-sm text-gray-400 mt-1">Portfolio Management</p>
            </div>

            <nav class="mt-6 px-4 space-y-2">

                <a href="{{ route('post.dashboard') }}"
                   class="block px-4 py-3 rounded-lg {{ request()->routeIs('post.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    Dashboard
                </a>

                <a href="{{ route('post.projects.index') }}"
                   class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    Projects
                </a>

                <a href="#"
                   class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    Categories
                </a>

                <a href="#"
                   class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    Technologies
                </a>

                <a href="#"
                   class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    Skills
                </a>

            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">

            <!-- Navbar -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">
                    Admin Dashboard
                </h2>

                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>