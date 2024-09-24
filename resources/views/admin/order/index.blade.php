@extends('layouts.admin')
@section('content')
<div class="card mb-4">
    <div class="card-header"> {{ __('messages.ordersByUser') }} </div>
    <div class="card-body">

        <h3>{{ __('messages.productOrders') }}</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('messages.userId') }}</th>
                    <th scope="col">{{ __('messages.nameUser') }}</th>
                    <th scope="col">{{ __('messages.orderId') }}</th>
                    <th scope="col">{{ __('messages.totalOrder') }}</th>
                    <th scope="col">{{ __('messages.date') }}</th>
                    <th scope="col">{{ __('messages.status') }}</th> 
                    <th scope="col">{{ __('messages.action') }}</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['ordersProductByUser'] as $userId => $orders)
                <tr>
                    <td rowspan="{{ count($orders) }}">{{ $userId }}</td>
                    <td rowspan="{{ count($orders) }}">{{ $orders->first()->user->name ?? __('messages.unknown') }}</td>
                    @foreach ($orders as $order)
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total }}$</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->status !== 'Shipped')
                                <form method="POST" action="{{ route('admin.order.shipOrder', ['id' => $order->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        Shipped
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-success">{{ __('messages.shipped') }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <h3>{{ __('messages.serviceOrders') }}</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('messages.userId') }}</th>
                    <th scope="col">{{ __('messages.nameUser') }}</th>
                    <th scope="col">{{ __('messages.orderId') }}</th>
                    <th scope="col">{{ __('messages.totalOrder') }}</th>
                    <th scope="col">{{ __('messages.date') }}</th>
                    <th scope="col">{{ __('messages.status') }}</th>
                    <th scope="col">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['ordersServiceByUser'] as $userId => $orders)
                <tr>
                    <td rowspan="{{ count($orders) }}">{{ $userId }}</td>
                    <td rowspan="{{ count($orders) }}">{{ $orders->first()->user->name ?? __('messages.unknown') }}</td>
                    @foreach ($orders as $order)
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total }}$</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->status !== 'Complete')
                                <form method="POST" action="{{ route('admin.order.shipService', ['id' => $order->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        Complete
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-success">{{ __('messages.complete') }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
