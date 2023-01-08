@extends('layout')
@section('title')
Edit Maintenance Record
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fs-4 bi bi-pen"></i> Maintenance Record Edit
                </div>
            </h4>
            @if ($errors->any())
            <div class="alert alert-danger">
                There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ url('MaintenanceManagement/' . $maintenances->id) }}" method="POST">
                {{csrf_field()}}
                @method("PATCH")
                <div class="card-body">
                    <h4><strong>Asset</strong></h4>
                    <input type="hidden" name="id" id="id" class="form-control" value="{{$maintenances->id}}">
                    <!-- Serial Number -->
                    <div class="form-group row">
                        <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial Number:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{$maintenances->serial_number}}">
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="form-group row">
                        <label for="location_id" class="col-sm-2 col-form-label"><strong>Location:</strong></label>
                        <div class="col-sm-10">
                            <select name="location_id" id="location_id" class="form-control">
                                @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $location->id == $asset->location_id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- category -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label"><strong>Category:</strong></label>
                        <div class="col-sm-10">
                            <select name="category" id="category" class="form-control">
                                <option value="computer" {{ $asset->category == 'computer' ? 'selected' : '' }}>Computer</option>
                                <option value="equipment" {{ $asset->category == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                <option value="laboratory" {{ $asset->category == 'laboratory' ? 'selected' : '' }}>Laboratory</option>
                                <option value="printers" {{ $asset->category == 'printers' ? 'selected' : '' }}>Printers</option>
                                <option value="networking_equipment" {{ $asset->category == 'networking_equipment' ? 'selected' : '' }}>Networking Equipment</option>
                                <option value="furniture" {{ $asset->category == 'furniture' ? 'selected' : '' }}>Furniture</option>
                                <option value="tools" {{ $asset->category == 'tools' ? 'selected' : '' }}>Tools</option>
                            </select>
                        </div>
                    </div>
                    <!-- Budget -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label"><strong>Budget:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="budget" id="budget" class="form-control" value="{{$asset->budget}}">
                        </div>
                    </div>
                </div>
                <div class="card-body">    
                    <!-- button -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-info" href="{{ url('MaintenanceManagement') }}"> Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection