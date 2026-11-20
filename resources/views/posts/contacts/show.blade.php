@extends('posts.layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('post.contacts.index') }}"
           class="btn btn-secondary">
            Kembali ke Pesan Masuk
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Detail Pesan</h2>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Nama Pengirim</strong>
                <p>{{ $contact->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Email</strong>
                <p>{{ $contact->email }}</p>
            </div>

            <div class="mb-3">
                <strong>Subjek</strong>
                <p>{{ $contact->subject }}</p>
            </div>

            <div class="mb-3">
                <strong>Isi Pesan</strong>
                <p style="white-space: pre-line;">{{ $contact->message }}</p>
            </div>

            <div class="mb-3">
                <strong>Dikirim pada</strong>
                <p>{{ $contact->created_at->format('d-m-Y H:i') }}</p>
            </div>

            <span class="badge bg-success">Sudah dibaca</span>
        </div>
    </div>
</div>
@endsection