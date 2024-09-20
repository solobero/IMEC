@extends('layouts.app')
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["services"] as $service)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            @if($service["image"])
            <img src="{{ asset('/storage/' . $service->getImage()) }}" class="card-img-top img-card" alt="{{ $service['name'] }}">
            @else
            <img src="{{ asset('storage/imagenes/juYAVeFlN1huOL14yjPhTB0DQtL6yb5uWH7PzoiP') }}" class="img-fluid rounded-start" alt="default">
            @endif
            <div class="card-body text-center">
                <a href="{{ route('service.show', ['id'=> $service['id']]) }}"
                    class="btn bg-primary text-white">{{ $service["name"] }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection