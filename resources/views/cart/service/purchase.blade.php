@extends('layouts.app') 
@section('subtitle', __('messages.purchaseStatusTitle')) 
@section('content') 
<div class="card">
    <div class="card-header">
        {{__('messages.purchaseComplete') }}
    </div>
    <div class="card-body">
        <div class="alert alert-success" role="alert"> {{__('messages.purchaseSuccess') }} 
            <b>#{{ $viewData["orderService"]->getId() }}</b> 
        </div>
    </div>  
</div> 
@endsection