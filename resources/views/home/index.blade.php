@extends('layouts.app')
@section('title','Home Page - IMEC')
@section('content')
<div class="text-center">
    <div class="card text-bg-dark">
        <img src="{{ asset('img/pc.jpg') }}" class="card-img w-100" alt="..." style="height: 530px; object-fit: cover;">
        <div class="card-img-overlay">
            <h5 class="card-title">¡Welcome!</h5>
            <p class="card-text">"Your reliable PC and component store with specialized technical support."</p>
        </div>
    </div>
</div>
@endsection