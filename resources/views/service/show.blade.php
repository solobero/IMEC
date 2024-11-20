@extends('layouts.app')
@section('subtitle', __('messages.servicesTitle'))
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            @if($viewData["service"]["image"])
            <img src="{{ asset('/storage/'.$viewData["service"]->getImage()) }}" class="img-fluid rounded-start" alt="{{ $viewData["service"]->getName() }}">
            @else
            <img src="{{ asset('images/default.jpeg') }}" class="img-fluid rounded-start" alt="default">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="card-title">
                    {{ $viewData["service"]["name"] }}
                </h3>
                <h5>{{__('messages.editDescription') }} </h5>
                <p class="card-text">{{ $viewData["service"]["description"] }}</p>
                <h5>{{__('messages.editPrice') }}</h5>
                <p class="card-text">{{ $viewData["service"]["price"] }}</p>
                <h5>{{__('messages.editCategory') }} </h5>
                <p class="card-text">{{ $viewData["service"]["category"] }}</p>
                <p class="card-text">
                <form method="POST" action="{{ route('cart.service.add', ['id'=> $viewData['service']->getId()]) }}">
                    <div class="row"> @csrf <div class="col-auto">
                            <div class="input-group col-auto">
                                <div class="input-group-text">{{__('messages.quantity') }}</div> <input type="number" min="1" max="10" class="form-control quantity-input" name="quantity" value="1">
                            </div>
                        </div>
                        <div class="col-auto"> <button class="btn btn-custom bg-custom text-white" type="submit">{{__('messages.cartAdd') }}</button> </div>
                    </div>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection