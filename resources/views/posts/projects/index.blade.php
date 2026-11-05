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

    <div class="space-y-4">
        @forelse($projects as $project)
            <div class="border rounded-lg p-4">
        
                @if($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="w-48 h-32 object-cover rounded-lg mb-4">
                @endif
        
                <a href="{{ route('post.projects.show', $project->id) }}"
                   class="font-bold text-blue-600 hover:underline">
                    {{ $project->title }}
                </a>
        
                <p>{{ $project->description }}</p>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('post.projects.edit', $project->id) }}"
                       style="background-color: #eab308; color: white;"
                       class="px-4 py-2 rounded-lg font-semibold inline-block">
                        Edit
                    </a>

                    <form action="{{ route('post.projects.destroy', $project->id) }}"
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
            <p>Belum ada project.</p>
        @endforelse
    </div>
</div>
@endsection