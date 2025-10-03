@extends('books.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Dashboard Admin</h4>
                </div>
                <div class="card-body">
                    <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
                    <p>Anda login sebagai Admin.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Kelola Buku</h5>
                                    <p class="card-text">Tambah, edit, dan hapus data buku perpustakaan</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-light">Kelola Buku</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Kelola Pengguna</h5>
                                    <p class="card-text">Tambah, edit, dan hapus data pengguna</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-light">Kelola Pengguna</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan</h5>
                                    <p class="card-text">Lihat laporan perpustakaan</p>
                                    <a href="{{ route('reports.index') }}" class="btn btn-light">Lihat Laporan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection