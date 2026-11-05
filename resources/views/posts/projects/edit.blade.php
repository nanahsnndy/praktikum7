@extends('posts.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-6">Edit Project</h2>

    <form action="{{ route('post.projects.update', $project->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category_id" class="block mb-2">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border rounded-lg p-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $project->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="title" class="block mb-2">Judul Project</label>
            <input type="text" name="title" id="title"
                   value="{{ $project->title }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2">Deskripsi</label>
            <textarea name="description" id="description"
                      class="w-full border rounded-lg p-2">{{ $project->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Thumbnail Saat Ini</label>

            @if($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}"
                     class="w-48 h-32 object-cover rounded-lg mb-2">
            @endif
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block mb-2">Ganti Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail"
                   accept="image/*" class="w-full border rounded-lg p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Update Project
        </button>
    </form>
</div>
@endsection
