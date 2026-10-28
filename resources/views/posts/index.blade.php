<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <style>
        nav[role="navigation"] svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

    <h1>Daftar Post</h1>

    <form action="{{ route('posts.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari judul post..."
            value="{{ $search ?? '' }}"
        >

        <select name="per_page">
            <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('posts.index') }}">Reset</a>
    </form>

    <a href="{{ route('posts.trash') }}">Lihat Trash</a>

    <hr>

    @foreach ($posts as $post)
        <h3>{{ $posts->firstItem() + $loop->index }}. {{ $post->title }}</h3>        <p>{{ $post->description }}</p>
        <p>Status: {{ $post->status }}</p>
        <hr>
    
    @endforeach

    <hr>

    <p>Halaman: {{ $posts->currentPage() }}</p>
    <p>Jumlah Data: {{ $posts->total() }}</p>
    <p>Data Per Halaman: {{ $posts->perPage() }}</p>

    {{ $posts->links() }}

</body>
</html>

</body>
</html>