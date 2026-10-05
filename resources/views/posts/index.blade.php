<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body>

    <h1>Daftar Post</h1>

    <a href="{{ route('posts.trash') }}">Lihat Trash</a>

    <hr>

    @foreach ($posts as $post)
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>
        <p>Status: {{ $post->status }}</p>
        <hr>
    @endforeach

</body>
</html>