
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>

                    <p class="mb-2">
                        Kamu berhasil login ke aplikasi.
                    </p>

                    <p class="mb-4">
                        Email: {{ Auth::user()->email }}
                    </p>

                    <a href="/posts"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Kelola Post
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
