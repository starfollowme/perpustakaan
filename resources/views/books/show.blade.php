@extends('books.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail Buku</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Judul:</strong>
                <p>{{ $book->judul }}</p>
            </div>
            <div class="mb-3">
                <strong>Penulis:</strong>
                <p>{{ $book->penulis }}</p>
            </div>
            <div class="mb-3">
                <strong>Penerbit:</strong>
                <p>{{ $book->penerbit }}</p>
            </div>
            <div class="mb-3">
                <strong>Tahun Terbit:</strong>
                <p>{{ $book->tahun_terbit }}</p>
            </div>
            <div class="mb-3">
                <strong>Kategori:</strong>
                <p>{{ $book->category?->nama ?? 'Tidak diketahui' }}</p>
            </div>
            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p>{{ $book->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="mb-3">
                <strong>Pengelola:</strong>
                <p>{{ $book->user?->name ?? 'Tidak diketahui' }}</p>
            </div>
            <div class="mb-3">
                <strong>Diperbarui pada:</strong>
                <p>{{ $book->updated_at->format('d-m-Y H:i') }}</p>
            </div>
            <div class="mb-3">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                @auth
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
