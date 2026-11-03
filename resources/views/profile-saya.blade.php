<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
</head>
<body>
    <h1>Profil Saya</h1>

    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <p>Role: {{ Auth::user()->role }}</p>

    <a href="/dashboard">Kembali ke Dashboard</a>
</body>
</html>
