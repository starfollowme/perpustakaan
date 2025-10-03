@extends('books.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Laporan Perpustakaan</h4>
                </div>
            </div>
        </div>

        <!-- Ringkasan -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $totalBooks }}</h3>
                                    <p class="mb-0">Total Buku</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $totalUsers }}</h3>
                                    <p class="mb-0">Total Pengguna</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengguna berdasarkan Role -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5>Pengguna berdasarkan Role</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usersByRole as $user)
                            <tr>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>{{ $user->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Buku berdasarkan Kategori -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Buku berdasarkan Kategori</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booksByCategory as $book)
                            <tr>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection