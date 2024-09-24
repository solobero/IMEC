@extends('layouts.app')
@section('subtitle', __('messages.servicesTitle'))
@section('content')

<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('service.search') }}" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="search" placeholder="Search services..." aria-label="Search" required>
            <button class="btn btn-outline-success" type="submit">
                <i class="bi bi-search"></i> <b>Search</b>
            </button>
        </form>
    </div>
</div>

<div class="row">
    @foreach ($viewData["services"] as $service)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            @if($service->getImage())
            <img src="{{ asset('/storage/' . $service->getImage()) }}" class="card-img-top img-card" alt="{{ $service->getName() }}">
            @else
            <img src="{{ asset('storage/default.jpeg') }}" class="img-fluid rounded-start" alt="default">
            @endif
            <div class="card-body text-center">
                <a href="{{ route('service.show', ['id'=> $service['id']]) }}"
                    class="btn bg-primary text-white">{{ $service->getName() }}
                </a>
                <p class="mt-2">
                    <strong>{{__('messages.editPrice') }} </strong>{{ $service->getPrice() }}$
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection