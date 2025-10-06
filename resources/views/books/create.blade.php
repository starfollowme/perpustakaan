@extends('books.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Buku Baru</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Masukkan judul buku">
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" placeholder="Masukkan nama penulis">
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit">
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" placeholder="Masukkan tahun terbit">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <div class="d-flex gap-2">
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">Tambah</a>
                    </div>
                    @if ($categories->isEmpty())
                        <small class="text-danger">Belum ada kategori. Tambahkan kategori terlebih dahulu melalui tombol "Tambah".</small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi buku">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-3">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
