@extends('layouts.app') 
@section('subtitle', __('messages.purchaseStatusTitle')) 
@section('content') 
<div class="card">
    <div class="card-header">
        {{ __('messages.purchaseComplete') }}
    </div>
    <div class="card-body">
        <div class="alert alert-success" role="alert">
            {{ __('messages.purchaseSuccess') }}
            <b>{{ $viewData["orderProduct"]->getId() }}</b>
        </div>
       
        <a href="{{ route('order.report.pdf', ['id' => $viewData['orderProduct']->getId()]) }}" class="btn btn-secondary">
           {{__('messages.reportPDF') }}
        </a>
        <a href="{{ route('order.report.txt', ['id' => $viewData['orderProduct']->getId()]) }}" class="btn btn-secondary">
           {{__('messages.reportTXT') }}
        </a>
    </div>
</div>
@endsection