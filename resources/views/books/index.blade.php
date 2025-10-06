@extends('books.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Daftar Buku</h4>
            @auth
                <a href="{{ route('books.create') }}" class="btn btn-success">Tambah Buku</a>
            @endauth
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pencarian -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ route('books.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, penerbit, tahun, atau kategori..." value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            @if(isset($search) && $search != '')
                                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Pengelola</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->category?->nama ?? 'Tidak diketahui' }}</td>
                            <td>{{ $book->user?->name ?? 'Tidak diketahui' }}</td>
                            <td>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Detail</a>

                                @auth
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                @if(isset($search) && $search != '')
                                    Tidak ditemukan buku dengan kata kunci "{{ $search }}"
                                @else
                                    Tidak ada data buku
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
