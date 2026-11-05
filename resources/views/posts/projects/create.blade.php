@extends('posts.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-6">Tambah Project</h2>

    @if(session('success'))
        <div style="background-color: #dcfce7; color: #166534; border: 1px solid #86efac;"
             class="px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;"
             class="px-4 py-3 rounded mb-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('post.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block mb-2">Judul Project</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title') }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block mb-2">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border rounded-lg p-2" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2">Deskripsi</label>
            <textarea name="description" id="description"
                      class="w-full border rounded-lg p-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block mb-2">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail"
                   class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label for="images" class="block mb-2">Gallery Images</label>
            <input type="file" name="images[]" id="images"
                   multiple accept="image/*"
                   class="w-full border rounded-lg p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Simpan Project
        </button>
    </form>
</div>
@endsection