@extends('layouts.admin') 
@section('content') 
<div class="card">
    <div class="card-header"> 
        {{__('messages.adminPanel') }}
    </div>
    <div class="card-body"> 
        {{__('messages.adminInstruction') }}
    </div>
</div> 
@endsection