@extends('layouts.app') 
@section('title', $viewData["title"]) 
@section('subtitle', $viewData["subtitle"]) 
@section('content') 
@forelse ($viewData["orderService"] as $orderService) 
<div class="card mb-4">
    <div class="card-header"> Order #{{ $orderService->getId() }} </div>
    <div class="card-body"> <b>Date:</b> {{ $orderService->getCreatedAt() }}<br /> <b>Total:</b> ${{ $orderService->getTotal() }}<br />

        <table class="table table-bordered table-striped text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">Item ID</th>
                    <th scope="col">Service Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody> 
            @if ($orderService->getItemsService())    
            @foreach ($orderService->getItemsService() as $itemService) <tr>
                    <td>{{ $itemService->getId() }}</td>
                    <td> <a class="link-success" href="{{ route('service.show', ['id'=> $itemService->getService()->getId()]) }}"> {{ $itemService->getService()->getName() }} </a> </td>
                    <td>${{ $itemService->getPrice() }}</td>
                    <td>{{ $itemService->getQuantity() }}</td>
                </tr> @endforeach 
                @else
                <tr>
                    <td colspan="4">No items found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div> @empty <div class="alert alert-danger" role="alert"> Seems to be that you have not purchased anything in our store =(. </div> 
@endforelse 
@endsection