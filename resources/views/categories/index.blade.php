@extends('books.layout')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-1">Daftar Kategori</h2>
            <p class="text-muted mb-0">Kelola kategori buku perpustakaan</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Tambah Kategori
        </a>
    </div>

    <!-- Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search Box -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama kategori atau deskripsi..."
                           value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    @if($search)
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card">
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th width="120" class="text-center">Total Buku</th>
                                <th width="200" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $category->nama }}</div>
                                </td>
                                <td>
                                    @if($category->deskripsi)
                                        {{ Str::limit($category->deskripsi, 50) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $category->books_count }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus kategori {{ $category->nama }}?')"
                                                    title="Hapus">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Search Results Info -->
                @if($search)
                <div class="mt-3 text-center">
                    <small class="text-muted">
                        Menampilkan {{ $categories->count() }} hasil untuk "{{ $search }}"
                        <a href="{{ route('categories.index') }}" class="text-decoration-none ms-2">
                            Tampilkan semua
                        </a>
                    </small>
                </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="bi bi-tags display-1 text-muted"></i>
                    <h5 class="mt-3 text-muted">
                        @if($search)
                            Tidak ada kategori ditemukan
                        @else
                            Belum ada kategori
                        @endif
                    </h5>
                    <p class="text-muted mb-4">
                        @if($search)
                            Coba gunakan kata kunci lain
                        @else
                            Mulai dengan menambahkan kategori pertama
                        @endif
                    </p>
                    @if(!$search)
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Kategori
                    </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
    }

    .table td {
        vertical-align: middle;
    }

    .card {
        border: 1px solid #e3e6f0;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .btn {
        border-radius: 0.35rem;
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }

    .badge {
        font-size: 0.75em;
        padding: 0.5em 0.75em;
    }

    .btn-sm {
        min-width: 70px;
    }
</style>
@endsection
