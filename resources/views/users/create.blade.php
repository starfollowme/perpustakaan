@extends('books.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Tambah Pengguna Baru</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Nama:</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                        </div>
                        <div class="form-group mb-3">
                            <p class="mb-0 text-muted">Pengguna baru akan otomatis mendapat akses Admin.</p>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('users.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
