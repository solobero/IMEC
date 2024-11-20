@extends('layouts.index')
@section('title', __('messages.name'))
@section('content')
<section>
    <img src="{{ asset('img/pc.jpg') }}">
    <img src="{{ asset('img/pc.jpg') }}">
    <img src="{{ asset('img/pc.jpg') }}">
    <img src="{{ asset('img/pc.jpg') }}">
    <div style="text-align: center;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 20px; font-weight: bold; padding: 10px; border-radius: 8px;">
            {{ __('messages.welcome') }} <br>
            {{ __('messages.slogan') }} <br>
            <a href="{{ route('lang.switch', ['lang' => 'en']) }}" class="btn btn-sm btn-outline-light me-2">{{ __('messages.english') }}</a>
            <a href="{{ route('lang.switch', ['lang' => 'es']) }}" class="btn btn-sm btn-outline-light">{{ __('messages.spanish') }}</a>
        </div>
    </div>
</section>
@endsection
