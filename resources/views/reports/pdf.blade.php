<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('messages.orderReport') }}</title>
    <link rel="stylesheet" href="{{ asset('css/pdfstyle.css') }}">
</head>
<body>
    <h1>{{__('messages.orderReport') }} {{ $orderProduct->getId() }}</h1>
    <p><strong>{{__('messages.creationDate') }}</strong> {{ $orderProduct->getCreatedAt() }}</p>
    <p><strong>{{__('messages.lastUpdate') }}</strong> {{ $orderProduct->getUpdatedAt() }}</p>
    <p><strong> {{__('messages.userId') }}:</strong> {{ $orderProduct->getUserId() }}</p>
    <p><strong> {{__('messages.totalOrder') }}:</strong> ${{ $orderProduct->getTotal() }}</p>

    <h2>{{__('messages.productDetails') }}</h2>
    <table>
        <thead>
            <tr>
                <th>{{__('messages.productName') }}</th>
                <th>{{__('messages.price') }}</th>
                <th>{{__('messages.quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderProduct->getItemsProduct() as $item)
                <tr>
                    <td>{{ $item->getProduct()->getName() }}</td>
                    <td>${{ $item->getPrice() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>