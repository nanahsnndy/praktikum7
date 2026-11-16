@extends('posts.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-6">Edit Project</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded mb-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('post.projects.update', $project->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block mb-2">Judul Project</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $project->title) }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block mb-2">Kategori</label>
            <select name="category_id" id="category_id"
                    class="w-full border rounded-lg p-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Teknologi yang Digunakan</label>

            <div class="flex flex-wrap gap-4">
                @forelse($technologies as $technology)
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="technologies[]"
                            value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }}
                        >
                        {{ $technology->name }}
                    </label>
                @empty
                    <p class="text-gray-500 text-sm">
                        Belum ada teknologi yang tersedia.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2">Deskripsi</label>
            <textarea name="description" id="description"
                      class="w-full border rounded-lg p-2">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Thumbnail Saat Ini</label>

            @if($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}"
                     class="w-48 h-32 object-cover rounded-lg mb-2">
            @else
                <p class="text-gray-500 text-sm">Belum ada thumbnail.</p>
            @endif
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block mb-2">Ganti Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail"
                   accept="image/*" class="w-full border rounded-lg p-2">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Update Project
        </button>
    </form>
</div>
@endsection
