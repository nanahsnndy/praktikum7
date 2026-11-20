@extends('posts.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pesan Masuk</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge bg-success">Sudah dibaca</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum dibaca</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('post.contacts.show', $contact->id) }}"
                                           class="btn btn-primary btn-sm">
                                            Lihat Pesan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $contacts->links() }}
            @else
                <p class="text-center mb-0">Belum ada pesan masuk.</p>
            @endif
        </div>
    </div>
</div>
@endsection