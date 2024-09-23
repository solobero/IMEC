@extends('layouts.admin') 
@section('content') 
<div class="card mb-4">
    <div class="card-header">{{__('messages.edit') }}</div>
    <div class="card-body"> 
        @if($errors->any()) 
        <ul class="alert alert-danger list-unstyled"> 
            @foreach($errors->all() as $error) 
            <li>- {{ $error }}</li> 
            @endforeach 
        </ul> 
        @endif 
        <form method="POST" action="{{ route('admin.service.update', ['id'=> $viewData['service']->getId()]) }}" 
        enctype="multipart/form-data"> 
        @csrf 
        @method('PUT') 
        <div class="row">
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editName') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input name="name" value="{{ $viewData['service']->getName() }}" type="text" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editPrice') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input name="price" value="{{ $viewData['service']->getPrice() }}" type="number" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col">
        <div class="mb-3 row"> 
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editCategory') }}</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <div class="form-group">
                    <select id="category" class="form-control mb-2" name="category">
                        <option value="">{{__('messages.editCategory') }}</option>
                        <option value="Preventive Maintenance" {{ $viewData['service']->getCategory() == 'Preventive Maintenance' ? 'selected' : '' }}>{{__('messages.categoryOne') }}</option>
                        <option value="Corrective Maintenance" {{ $viewData['service']->getCategory() == 'Corrective Maintenance' ? 'selected' : '' }}>{{__('messages.categoryTwo') }}</option>
                        <option value="Predictive Maintenance" {{ $viewData['service']->getCategory() == 'Predictive Maintenance' ? 'selected' : '' }}>{{__('messages.categoryThree') }}</option>
                        <option value="Technical Specialized Maintenance" {{ $viewData['service']->getCategory() == 'Technical Specialized Maintenance' ? 'selected' : '' }}>{{__('messages.categoryFour') }}</option>
                        <option value="Software/Hardware Maintenance" {{ $viewData['service']->getCategory() == 'Software/Hardware Maintenance' ? 'selected' : '' }}>{{__('messages.categoryFive') }}</option>
                        <option value="Facility Maintenance" {{ $viewData['service']->getCategory() == 'Facility Maintenance' ? 'selected' : '' }}>{{__('messages.categorySix') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.editImage') }}</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input class="form-control" type="file" name="image"> 
                        </div>
                    </div>
                </div>
                <div class="col"> &nbsp; </div>
            </div>
            <div class="mb-3"> <label class="form-label">{{__('messages.editDescription') }}</label> 
            <textarea class="form-control" name="description" 
                rows="3">{{ $viewData['service']->getDescription() }}</textarea> 
            </div> 
            <button type="submit" class="btn btn-primary">{{__('messages.submit') }}</button>
        </form>
    </div>
</div> @endsection