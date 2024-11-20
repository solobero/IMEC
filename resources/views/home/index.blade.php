@extends('layouts.index')

@section('title', __('messages.name'))
@section('content')
<section>
    <img src="{{ asset('img/pc.jpg') }}" alt="Botón Imagen" style="cursor: pointer;" onclick="alert('¡Hiciste clic en la imagen!')">
    <img src="{{ asset('img/pc.jpg') }}">
    <img src="{{ asset('img/pc.jpg') }}">
    <img src="{{ asset('img/pc.jpg') }}">
    <div style="text-align: center;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 20px; font-weight: bold; padding: 10px; border-radius: 8px;">
            {{ __('messages.welcome') }} <br>
            {{ __('messages.slogan') }}
        </div>
    </div>
</section>
@endsection
