@extends('books.layout')

@section('content')
<!-- Pastikan link Bootstrap Icons ada di layout utama Anda -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"> -->

<!-- CSS Khusus untuk Halaman Dashboard -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');

    body {
        background-color: #f8f9fa;
        font-family: 'Nunito', sans-serif;
    }

    .dashboard-container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-weight: 700;
        color: #343a40;
    }

    .dashboard-header p {
        color: #6c757d;
    }

    .custom-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .custom-card .card-header {
        font-weight: 600;
        border-bottom: none;
        padding: 1.25rem;
    }

    .custom-card .card-header i {
        margin-right: 0.5rem;
    }

    .custom-card .list-group-item {
        border: none;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        transition: background-color 0.2s ease;
    }

    .custom-card .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .custom-card .list-group-item h6 {
        font-weight: 600;
        color: #495057;
    }

    .custom-card .list-group-item .badge {
        font-size: 0.8em;
    }

    .custom-card .card-footer {
        background-color: #fff;
        border-top: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
    }

    .btn-custom {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
    }

    .empty-state {
        padding: 2rem;
        text-align: center;
        color: #adb5bd;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
</style>

<div class="container dashboard-container">
    <div class="dashboard-header text-center">
        <h1>Selamat Datang di Dashboard Perpustakaan</h1>
        <p class="lead">Pantau buku dan kategori terbaru dengan mudah.</p>
    </div>

    <div class="row g-4">
        <!-- Card Buku Terbaru -->
        <div class="col-12 col-lg-6">
            <div class="card custom-card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-journal-text"></i> Buku Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($books as $book)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-book-half text-primary me-2"></i>{{ $book->judul }}</h6>
                                        <small class="text-muted">Kategori: {{ $book->category?->nama ?? 'Tidak diketahui' }}</small>
                                    </div>
                                    <span class="badge bg-info text-dark">{{ $book->tahun_terbit }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item empty-state">
                                <i class="bi bi-inbox"></i>
                                <div>Belum ada buku yang tersedia.</div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('user.books') }}" class="btn btn-outline-primary btn-custom btn-sm">
                        Lihat Semua <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kategori Populer -->
        <div class="col-12 col-lg-6">
            <div class="card custom-card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-tags"></i> Kategori Populer</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-tag-fill text-success me-2"></i>{{ $category->nama }}</span>
                                <span class="badge bg-success">{{ $category->books_count }} buku</span>
                            </li>
                        @empty
                            <li class="list-group-item empty-state">
                                <i class="bi bi-tags"></i>
                                <div>Belum ada kategori tersedia.</div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Hubungi admin bila ingin menambahkan kategori baru.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
