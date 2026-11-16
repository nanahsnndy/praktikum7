@extends('posts.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Project</h2>

        <a href="{{ route('post.projects.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Tambah Project
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('post.projects.index') }}"
          method="GET"
          class="flex flex-wrap gap-3 mb-6">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul atau deskripsi project..."
            class="border rounded-lg px-4 py-2 flex-1 min-w-[200px]"
        >

        <select name="status"
                class="border rounded-lg px-4 py-2 pr-10 min-w-[190px] bg-white shrink-0">
            <option value="">Semua Status</option>

            <option value="draft"
                {{ request('status') == 'draft' ? 'selected' : '' }}>
                Draft
            </option>

            <option value="published"
                {{ request('status') == 'published' ? 'selected' : '' }}>
                Published
            </option>
        </select>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Cari
        </button>

        <a href="{{ route('post.projects.index') }}"
           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
            Reset
        </a>
    </form>

    <p class="text-gray-600 mb-4">
        {{ $projects->total() }} hasil ditemukan
    </p>

    <div class="space-y-4">
        @forelse($projects as $project)

            <div class="border rounded-lg p-4">

                @if($project->thumbnail)
                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="w-48 h-32 object-cover rounded-lg mb-4">
                @endif

                <a href="{{ route('post.projects.show', $project->id) }}"
                   class="font-bold text-blue-600 hover:underline">
                    {{ $project->title }}
                </a>

                <p>{{ $project->description }}</p>

                <p class="text-sm text-gray-500 mt-2">
                    Status: {{ ucfirst($project->status) }}
                </p>

                <div class="flex gap-2 mt-4">

                    <a href="{{ route('post.projects.edit', $project->id) }}"
                       style="background-color: #eab308; color: white;"
                       class="px-4 py-2 rounded-lg font-semibold inline-block">
                        Edit
                    </a>

                    <form
                        action="{{ route('post.projects.destroy', $project->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus project ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg">
                            Hapus
                        </button>
                    </form>

                </div>
            </div>

        @empty
            <p class="text-gray-500 py-4">
                Tidak ada project yang cocok dengan pencarian atau filter.
            </p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

</div>
@endsection
