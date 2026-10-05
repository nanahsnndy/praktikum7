<!DOCTYPE html>
<html>
<head>
    <title>Trash</title>
</head>
<body>

    <h1>Trash</h1>

    <a href="{{ route('posts.index') }}">Kembali ke Posts</a>

    <hr>

    @forelse ($posts as $post)

        <h3>{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>

        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
            @csrf
            <button type="submit">Restore</button>
        </form>

        <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus Permanen</button>
        </form>

        <hr>

    @empty

        <p>Trash masih kosong.</p>

    @endforelse

</body>
</html>