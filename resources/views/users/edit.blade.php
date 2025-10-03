@extends('books.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Edit Pengguna</h4>
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Nama:</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password: <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small></label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                        </div>
                        <div class="form-group mb-3">
                            <p class="mb-0 text-muted">Akses pengguna ini tetap sebagai Admin.</p>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-secondary" href="{{ route('users.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
