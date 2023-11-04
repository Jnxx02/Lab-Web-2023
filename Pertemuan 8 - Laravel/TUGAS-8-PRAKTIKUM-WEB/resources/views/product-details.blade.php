@extends('layout.template')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body" style="background-color: #e3f2fd;">
                <div class="row">
                    <div class="col-md-4 my-2">
                        <img src="https://cdn.pixabay.com/photo/2023/06/16/00/08/car-model-8066716_1280.jpg" 
                            alt="Product Image" class="img-fluid">
                    </div>
                    <div class="col-md-8 my-4">
                        @foreach ($productdetails as $item)
                            <h2>{{ $item->productName }} <span class="badge text-bg-primary small-badge">{{ $item->productLine }}</span></h2> 
                            <p>{{ $item->productDescription }}</p>
                            <p>Stock: {{ $item->quantityInStock }}</p>
                            {{-- <p>Price: ${{ $item->price }}</p>
                            <p>Stock: {{ $item->stock }}</p> --}}
                            <a href="#" class="btn btn-primary">Buy Now</a>
                            <a href="{{ route('product') }}" class="btn btn-outline-success">Back</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .small-badge {
            letter-spacing: 0.5px;
            line-height: 1.5;
            font-size: medium;
        }
    </style>
@endsection
