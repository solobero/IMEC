@extends('layouts.app') 
@section('subtitle', __('messages.ordersTitle'))  
@section('content') 
@forelse ($viewData["orderService"] as $orderService) 
<div class="card mb-4">
    <div class="card-header"> {{__('messages.order') }} {{ $orderService->getId() }} </div>
    <div class="card-body"> 
        <b>{{__('messages.date') }}</b> {{ $orderService->getCreatedAt() }}<br /> 
        <b>{{__('messages.total') }}</b> {{ $orderService->getTotal() }}<br />
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
            @if ($orderService->getItemsService())    
            @foreach ($orderService->getItemsService() as $itemService) 
                <tr>
                    <td> 
                        <a class="link-success" href="{{ route('service.show', ['id'=> $itemService->getService()->getId()]) }}"> 
                            {{ $itemService->getService()->getName() }} 
                        </a> 
                    </td>
                    <td>${{ $itemService->getPrice() }}</td>
                    <td>{{ $itemService->getQuantity() }}</td>
                    <td>{{ $orderService->getStatus() }}</td> 
                </tr> 
            @endforeach 
            @else
                <tr>
                    <td colspan="4">{{__('messages.notAndOrder') }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div> 
@empty 
<div class="alert alert-danger" role="alert">{{__('messages.notAnOrder') }}</div> 
@endforelse 
@endsection
