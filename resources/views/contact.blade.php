
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>

    <h1>Contact Us</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}" required>
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="subject">Subjek:</label>
            <input type="text" id="subject" name="subject"
                   value="{{ old('subject') }}" required>
            @error('subject')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="message">Pesan:</label>
            <textarea id="message" name="message" required>{{ old('message') }}</textarea>
            @error('message')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Kirim Pesan</button>
    </form>

</body>
</html>