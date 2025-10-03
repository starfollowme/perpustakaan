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
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
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
                            <td colspan="6" class="text-center">Tidak ada data buku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
