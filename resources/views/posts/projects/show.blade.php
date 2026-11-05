
@extends('posts.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">{{ $project->title }}</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($project->thumbnail)
        <img
            src="{{ asset('storage/' . $project->thumbnail) }}"
            alt="{{ $project->title }}"
            class="w-full max-w-md rounded-lg mb-4"
        >
    @endif

    <p class="mb-6">{{ $project->description }}</p>

    <div class="border-t pt-5 mt-5">
        <h3 class="text-xl font-semibold mb-3">Tambah Gambar Gallery</h3>

        <p class="text-sm text-gray-600 mb-3">
            Maksimal 10 gambar untuk setiap project.
            Gambar saat ini: {{ $project->images->count() }}/10.
        </p>

        <form
            action="{{ route('post.projects.gallery.store', $project->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <input
                type="file"
                name="images[]"
                accept="image/jpeg,image/png,image/webp"
                multiple
                required
                class="block w-full mb-3"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Upload Gambar
            </button>
        </form>
    </div>

    <div class="border-t pt-5 mt-6">
        <h3 class="text-xl font-semibold mb-4">Gallery</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($project->images as $image)
                <div class="border rounded-lg p-3">

                    <img
                        src="{{ asset('storage/' . $image->image) }}"
                        alt="{{ $image->caption ?? 'Gallery image' }}"
                        class="w-full h-48 object-cover rounded mb-3"
                    >

                    <form
                        action="{{ route('post.projects.gallery.update', [$project->id, $image->id]) }}"
                        method="POST"
                        class="mb-3"
                    >
                        @csrf
                        @method('PUT')

                        <label class="block text-sm font-medium mb-1">
                            Caption
                        </label>

                        <input
                            type="text"
                            name="caption"
                            value="{{ $image->caption }}"
                            maxlength="255"
                            placeholder="Masukkan caption gambar"
                            class="w-full border rounded px-3 py-2 mb-2"
                        >

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700"
                        >
                            Simpan Caption
                        </button>
                    </form>

                    <form
                        action="{{ route('post.projects.gallery.destroy', [$project->id, $image->id]) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus gambar ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700"
                        >
                            Hapus Gambar
                        </button>
                    </form>

                </div>
            @empty
                <p class="text-gray-500">Belum ada gambar gallery.</p>
            @endforelse
        </div>
    </div>

    <a
        href="{{ route('post.projects.index') }}"
        class="inline-block mt-6 text-blue-600 hover:underline"
    >
        Kembali ke daftar project
    </a>

</div>
@endsection
