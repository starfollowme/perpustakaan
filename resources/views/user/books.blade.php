@extends('books.layout')

@section('content')
@php($search = $search ?? '')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Koleksi Buku</h4>
    </div>
    <div class="card-body">
        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('user.books') }}" method="GET">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari buku berdasarkan judul, penulis, atau kategori..."
                               value="{{ $search }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if($search)
                        <a href="{{ route('user.books') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                @if($search)
                <div class="alert alert-info py-2 mb-0">
                    <small>
                        <i class="fas fa-info-circle"></i>
                        Menampilkan {{ $books->total() }} hasil untuk pencarian:
                        <strong>"{{ $search }}"</strong>
                    </small>
                </div>
                @endif
            </div>
        </div>

        <!-- Books Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                    <tr>
                        <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>
                            @if($book->category)
                                <span class="badge bg-primary">{{ $book->category->nama }}</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>{{ $book->tahun_terbit }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            @if($search)
                                Tidak ada buku yang ditemukan untuk pencarian "{{ $search }}"
                            @else
                                Belum ada data buku.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center">
            <div>
                @if($books->total() > 0)
                <small class="text-muted">
                    Menampilkan {{ $books->firstItem() }} - {{ $books->lastItem() }} dari {{ $books->total() }} buku
                </small>
                @endif
            </div>
            <div>
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
