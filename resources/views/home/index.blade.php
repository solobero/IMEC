@extends('layouts.app')
@section('title', __('messages.name'))
@section('content')
<div class="text-center">
    <div class="card text-bg-dark">
        <img src="{{ asset('img/pc.jpg') }}" class="card-img w-100" alt="..." style="height: 530px; object-fit: cover;">
        <div class="card-img-overlay">
            <h5 class="card-title">{{__('messages.welcome') }}</h5>
            <p class="card-text">{{__('messages.slogan') }}</p>
        </div>
    </div>
</div>
@endsection