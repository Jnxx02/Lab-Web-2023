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
    <div class="card mx-5" id="editModal" aria-labelledby="editModalLabel" style="background-color: #e3f2fd;">
        <div class="card-dialog">
            <div class="card-content">
                <div class="card-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Produk</h5>
                </div>
                <div class="card-body">
                    <form action="/products/update/{{ $data->id }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" required
                            value="{{ $data->nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="harga" name="harga" required
                            value="{{ $data->harga }}">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Jumlah Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" required
                            value="{{ $data->stok }}">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required
                            value="{{ $data->deskripsi }}">
                        </div>
                        <button type="submit" name="edit_data" class="btn btn-outline-primary">Simpan Perubahan</button>
                        <a href="/products" class="btn btn-outline-danger">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection