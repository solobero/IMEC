@extends('layouts.app')
@section('title', __('messages.productsTitle'))
@section('subtitle', __('messages.productsTitle'))
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('product.search') }}" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="search" placeholder="Search for products..." aria-label="Search" required>
            <select name="sort" class="form-select me-2" onchange="this.form.submit()">
                <option value="">{{ __('messages.sortBy') }}</option>
                <option value="alphabetical">{{ __('messages.alphabetical') }}</option>
                <option value="price">{{ __('messages.priceLowToHigh') }}</option>
            </select>
            <button class="btn btn-outline-success btn-custom" type="submit">
                <i class="bi bi-search"></i> <b>{{ __('messages.search') }}</b>
            </button>
        </form>
    </div>
</div>
<div class="text-center mb-4">
    <b>{{ __('messages.checkOut')}}</b>
    <a href="{{ route('product.best_sellers') }}" class="best-sellers-link"><b>{{ __('messages.bestSelling') }}</b></a>
</div>
<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-6 mb-4">
        <div class="card">
            @if($product->getImage())
            <img src="{{ asset('storage/' . $product->getImage()) }}" alt="{{ $product->getName() }}" class="card-img-top img-card">
            @else
            <img src="{{ asset('storage/default.jpeg') }}" class="img-fluid rounded-start" alt="default">
            @endif
            <div class="card-body text-center">
                <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn btn-custom bg-custom text-white">
                    {{ $product->getName() }}
                </a>
                <p class="mt-2">
                    <strong>{{ __('messages.editPrice') }}</strong> {{ $product->getPrice() }}$
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
