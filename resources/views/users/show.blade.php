@extends('books.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Detail Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <strong>Nama:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Hak Akses:</strong>
                        {{ ucfirst($user->role) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Total Buku Dikelola:</strong>
                        {{ $user->books_count }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Tanggal Registrasi:</strong>
                        {{ $user->created_at->format('d-m-Y H:i:s') }}
                    </div>
                    <div class="form-group mb-3">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <a class="btn btn-secondary" href="{{ route('users.index') }}">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
