@extends('posts.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-2">Daftar Project</h1>
    <p class="text-gray-600 mb-8">
        Berikut adalah kumpulan project yang telah dikerjakan.
    </p>

    <form action="{{ route('projects.index') }}" method="GET"
        class="bg-white rounded-lg shadow p-5 mb-8">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari project..."
                class="border rounded-lg px-4 py-2 w-full"
            >

            <select name="category" class="border rounded-lg px-4 py-2 w-full">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}"
                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="technology" class="border rounded-lg px-4 py-2 w-full">
                <option value="">Semua Teknologi</option>
                @foreach($technologies as $technology)
                    <option value="{{ $technology->slug }}"
                        {{ request('technology') == $technology->slug ? 'selected' : '' }}>
                        {{ $technology->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="border rounded-lg px-4 py-2 w-full">
                <option value="terbaru" {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>
                    Terbaru
                </option>
                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>
                    Terlama
                </option>
                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>
                    Nama A-Z
                </option>
            </select>

        </div>

        <div class="flex gap-3 mt-4">
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Cari
            </button>

            <a href="{{ route('projects.index') }}"
                class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300">
                Reset
            </a>
        </div>

    </form>

    <p class="text-gray-600 mb-5">
        {{ $projects->total() }} hasil ditemukan
    </p>

    @if($projects->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($projects as $project)

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    @if($project->thumbnail)
                        <img
                            src="{{ asset('storage/' . $project->thumbnail) }}"
                            alt="{{ $project->title }}"
                            class="w-full h-52 object-cover"
                        >
                    @endif

                    <div class="p-5">

                        <h2 class="text-xl font-bold mb-2">
                            {{ $project->title }}
                        </h2>

                        @if($project->category)
                            <p class="text-sm text-blue-600 mb-2">
                                {{ $project->category->name }}
                            </p>
                        @endif

                        <p class="text-gray-600 mb-4">
                            {{ $project->short_description ?? Str::limit($project->description, 120) }}
                        </p>

                        @if($project->technologies->count())
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies as $technology)
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">
                                        {{ $technology->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('projects.public.show', $project->slug) }}"
                            class="text-blue-600 font-semibold hover:underline">
                            Lihat Detail →
                        </a>

                    </div>
                </div>

            @endforeach

        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>

    @else

        <div class="bg-white rounded-lg shadow p-10 text-center">
            <p class="text-gray-500">
                Tidak ada project yang ditemukan.
            </p>
        </div>

    @endif

</div>

@endsection
