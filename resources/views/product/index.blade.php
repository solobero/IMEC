@extends('layouts.app')
@section('subtitle', __('messages.productsTitle'))
@section('content')


<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('product.search') }}" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="search" placeholder="Search for products..." aria-label="Search" required>
            <button class="btn btn-outline-success" type="submit">
                <i class="bi bi-search"></i> <b>Search</b>
            </button>
        </form>
    </div>
</div>


<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            @if($product["image"])
            <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card" alt="{{ $product['name'] }}">
            @else
            <img src="{{ asset('storage/imagenes/juYAVeFlN1huOL14yjPhTB0DQtL6yb5uWH7PzoiP') }}" class="img-fluid rounded-start" alt="default">
            @endif
            <div class="card-body text-center">
                <a href="{{ route('product.show', ['id'=> $product['id']]) }}"
                    class="btn bg-primary text-white">{{ $product["name"] }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection