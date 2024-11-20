@extends('layouts.app')
@section('title', __('messages.cartTitle'))
@section('subtitle', __('messages.cartTitle'))
@section('content') <div class="card">
    <div class="card-header"> {{__('messages.cartProductSubtitle') }} </div>
    <div class="card-body">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div>
            <p>Saldo disponible: ${{ $viewData['balance'] }}</p>
        </div>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.id') }}</th>
                    <th scope="col">{{__('messages.editName') }}</th>
                    <th scope="col">{{__('messages.editPrice') }}</th>
                    <th scope="col">{{__('messages.quantity') }}</th>
                </tr>
            </thead>
            <tbody> @foreach ($viewData["products"] as $product) <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>${{ $product->getPrice() }}</td>
                    <td>{{ session('products')[$product->getId()] }}</td>
                </tr>
                @endforeach </tbody>
        </table>
        <div class="row">
            <div class="text-end"> <a class="btn btn-custom btn-outline-secondary mb-2"><b>{{__('messages.total') }}</b> ${{ $viewData["total"] }}</a>
                @if (count($viewData["products"]) > 0)
                <a href="{{ route('cart.product.purchase') }}" class="btn btn-custom bg-custom text-white mb-2">{{__('messages.purchase') }}</a>
                <a href="{{ route('cart.product.delete') }}">
                    <button class="btn btn-custom mb-2">
                        {{__('messages.emptyCart') }}
                    </button>
                </a>
                @endif
            </div>
        </div>
    </div>
</div> @endsection