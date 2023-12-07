@extends('layout.template')

@section('content')
    <style>
        .card {
            height: 100%;
        }

        .card-title {
            letter-spacing: 0.5px;
            line-height: 1.5;
        }
        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-text {
            flex-grow: 1;
            overflow: hidden;
        }
    </style>
    <div class="text-end mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah +
        </button>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="card-body" style="background-color: #e3f2fd; padding: 20px;">
        <div class="row mb-3">
            @foreach ($product as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="https://image.popmama.com/content-images/post/20191114/img-14112019-104753-800-x-420-piksel-c9d6341d18cf1a922fe66416013caca4.jpg" 
                        class="card-img-top shadow" alt="Product Image">
                        <div class="card-body" style="background-color: #f5f5f5;">
                            <h5 class="card-title" style="font-size: 1.25rem;">{{ $item->nama }}</h5>
                            <p class="card-text">{{ substr($item->deskripsi, 0, 100) }}...</p>
                            <h6 class="text-start mb-3">Harga: Rp{{ $item->harga }}</h6>
                            <h6 class="text-end mb-3">Stock: {{ $item->stok }}</h6>
                        </div>
                        <div class="text-center mb-3">
                            <a href="/products/edit/{{ $item->id }}" class="btn btn-outline-info">Ubah</a>
                            <a href="/products/destroy/{{ $item->id }}" class="btn btn-outline-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store', ['id' => '']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Jumlah Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                        <button type="submit" name="tambah_data" class="btn btn-outline-primary">Tambahkan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection