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

    <div class="card-body" style="background-color: #e3f2fd; padding: 20px;">
        <div class="row mt-3">
            @foreach ($products as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="https://cdn.pixabay.com/photo/2023/06/16/00/08/car-model-8066716_1280.jpg" 
                        class="card-img-top shadow" alt="Product Image">
                        <div class="card-body" style="background-color: #f5f5f5;">
                            <h5 class="card-title" style="font-size: 1.25rem;">{{ $item->productName }}
                                <span class="badge text-bg-primary">{{ $item->productLine }}</span>
                            </h5>
                            <p class="card-text">{{ substr($item->productDescription, 0, 100) }}...</p>
                            <h6 class="text-end mb-3">Stock: {{ $item->quantityInStock }}</h6>
                            <a href="/products/{{ $item->productCode }}" class="btn btn-primary mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

{{-- <div class="row align-items-center">
    <label class="col-md-3 text-end">Stock:</label>
    <div class="col-md-4">
    <input type="number" class="form-control" value="{{ $item->quantityInStock }}" disabled>
    </div>
    </div> --}}
