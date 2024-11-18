@extends('layouts.app') 
@section('subtitle', __('messages.cartTitle')) 
@section('content') <div class="card">
    <div class="card-header"> {{__('messages.cartServiceSubtitle') }} </div>
    <div class="card-body">
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
            <tbody> @foreach ($viewData["services"] as $service) <tr>
                    <td>{{ $service->getId() }}</td>
                    <td>{{ $service->getName() }}</td>
                    <td>${{ $service->getPrice() }}</td>
                    <td>{{ session('services')[$service->getId()] }}</td>
                </tr>
                @endforeach </tbody>
        </table>
        <div class="row">
            <div class="text-end"> <a class="btn btn-outline-secondary mb-2"><b>{{__('messages.total') }}</b> ${{ $viewData["total"] }}</a>
                @if (count($viewData["services"]) > 0)
                <a href="{{ route('cart.service.purchase') }}"  class="btn bg-primary text-white mb-2">{{__('messages.purchase') }}</a>
                <a href="{{ route('cart.service.delete') }}">
                    <button class="btn btn-danger mb-2">
                        {{__('messages.emptyCart') }}
                    </button>
                </a>
                @endif
            </div>
        </div>
    </div>
</div> 
@endsection