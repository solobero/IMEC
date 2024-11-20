@extends('layouts.app') 
@section('title', __('messages.ordersTitle')) 
@section('subtitle', __('messages.ordersTitle')) 
@section('content') 
@forelse ($viewData["orderProduct"] as $orderProduct) 
<div class="card mb-4">
    <div class="card-header"> {{__('messages.order') }}{{ $orderProduct->getId() }} </div>
    <div class="card-body"> <b>{{__('messages.date') }}</b> {{ $orderProduct->getCreatedAt() }}<br /> <b>{{__('messages.total') }}</b> {{ $orderProduct->getTotal() }}<br />
        <table class="table table-bordered table-striped text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.editName') }}</th>
                    <th scope="col">{{__('messages.editPrice') }}</th>
                    <th scope="col">{{__('messages.quantity') }}</th>
                    <th scope="col">{{__('messages.status') }}</th>
                </tr>
            </thead>
            <tbody> 
            @if ($orderProduct->getItemsProduct())    
            @foreach ($orderProduct->getItemsProduct() as $itemProduct) <tr>
                    <td> <a class="link-success" href="{{ route('product.show', ['id'=> $itemProduct->getProduct()->getId()]) }}"> {{ $itemProduct->getProduct()->getName() }} </a> </td>
                    <td>${{ $itemProduct->getPrice() }}</td>
                    <td>{{ $itemProduct->getQuantity() }}</td>
                    <td>{{ $orderProduct->getStatus() }}</td> 
                </tr> @endforeach 
                @else
                <tr>
                    <td colspan="4">{{__('messages.notAndOrder') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div> @empty <div class="alert alert-danger" role="alert">{{__('messages.notAnOrder') }}</div> 
@endforelse 
@endsection