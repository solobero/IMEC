@extends('layouts.app')
@section('subtitle', __('messages.bestSellingProducts'))
@section('content')


<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            @if($product->getImage()) 
            <img src="{{ asset('storage/' . $product->getImage()) }}" alt="{{ $product->getName() }}" class="card-img-top img-card" alt="{{ $product->getName() }}">
            @else
            <img src="{{ asset('storage/default.jpeg') }}" class="img-fluid rounded-start" alt="default">
            @endif
            <div class="card-body text-center">
                <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn bg-primary text-white">
                    {{ $product->getName() }}
                </a>
                <p class="mt-2">
                    <strong>{{__('messages.editPrice') }} </strong>{{ $product->getPrice() }}$
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
