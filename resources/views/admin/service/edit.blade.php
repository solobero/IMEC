@extends('layouts.admin') 
@section('content') 
<div class="card mb-4">
    <div class="card-header"> Edit Service </div>
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
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input name="name" value="{{ $viewData['service']->getName() }}" type="text" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input name="price" value="{{ $viewData['service']->getPrice() }}" type="number" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col">
        <div class="mb-3 row"> 
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Category:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <div class="form-group">
                    <select id="category" class="form-control mb-2" name="category">
                        <option value="">Select category</option>
                        <option value="Preventive Maintenance" {{ $viewData['service']->getCategory() == 'Preventive Maintenance' ? 'selected' : '' }}>Preventive Maintenance</option>
                        <option value="Corrective Maintenance" {{ $viewData['service']->getCategory() == 'Corrective Maintenance' ? 'selected' : '' }}>Corrective Maintenance</option>
                        <option value="Predictive Maintenance" {{ $viewData['service']->getCategory() == 'Predictive Maintenance' ? 'selected' : '' }}>Predictive Maintenance</option>
                        <option value="Technical Specialized Maintenance" {{ $viewData['service']->getCategory() == 'Technical Specialized Maintenance' ? 'selected' : '' }}>Technical Specialized Maintenance</option>
                        <option value="Software/Hardware Maintenance" {{ $viewData['service']->getCategory() == 'Software/Hardware Maintenance' ? 'selected' : '' }}>Software/Hardware Maintenance</option>
                        <option value="Facility Maintenance" {{ $viewData['service']->getCategory() == 'Facility Maintenance' ? 'selected' : '' }}>Facility Maintenance</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3 row"> <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12"> 
                            <input class="form-control" type="file" name="image"> 
                        </div>
                    </div>
                </div>
                <div class="col"> &nbsp; </div>
            </div>
            <div class="mb-3"> <label class="form-label">Description</label> 
            <textarea class="form-control" name="description" 
                rows="3">{{ $viewData['service']->getDescription() }}</textarea> 
            </div> 
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div> @endsection