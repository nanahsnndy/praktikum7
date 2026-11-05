@extends('posts.layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow-md p-6">

        <a href="/" class="text-blue-600 hover:underline">
            &larr; Kembali ke halaman utama
        </a>

        <h1 class="text-3xl font-bold mt-4 mb-2">
            {{ $project->title }}
        </h1>

        @if($project->category)
            <p class="text-gray-500 mb-4">
                Kategori: {{ $project->category->name }}
            </p>
        @endif

        @if($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                alt="{{ $project->title }}"
                class="w-full max-h-96 object-cover rounded-lg mb-6"
            >
        @endif

        <div class="text-gray-700 mb-8">
            {{ $project->description }}
        </div>

        @if($project->skills->count() > 0)
            <h2 class="text-xl font-bold mb-3">
                Skills
            </h2>

            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($project->skills as $skill)
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-4">
            Gallery
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @forelse($project->images as $image)
                <div class="bg-gray-50 rounded-lg overflow-hidden">

                    <img
                        src="{{ asset('storage/' . $image->image) }}"
                        alt="{{ $image->caption ?? $project->title }}"
                        class="w-full h-64 object-cover"
                    >

                    @if($image->caption)
                        <p class="p-3 text-gray-700">
                            {{ $image->caption }}
                        </p>
                    @endif

                </div>
            @empty
                <p class="text-gray-500">
                    Belum ada gambar gallery.
                </p>
            @endforelse

        </div>

    </div>

</div>

@endsection