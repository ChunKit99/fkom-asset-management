@extends('layout')
@section('title')
Add Asset
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-file-earmark-plus"></i> Asset Information Add
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
            <!-- go to asset controller -->
            <form action="{{ url('Asset') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                    <h4><strong>Asset</strong></h4>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label"><strong>Upload Images:</strong></label>
                        <div class="col-sm">
                            <input class="form-control" type="file" id="image" name="image" accept="image/jpg,image/png,image/jpg">
                        </div>
                    </div>
                    <!-- Serial Number -->
                    <div class="form-group row">
                        <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial Number:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="serial_number" id="serial_number" class="form-control" value="">
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="form-group row">
                        <label for="location_id" class="col-sm-2 col-form-label"><strong>Location:</strong></label>
                        <div class="col-sm-10">
                            <select name="location_id" id="location_id" class="form-select">
                                @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- category -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label"><strong>Category:</strong></label>
                        <div class="col-sm-10">
                            <select name="category" id="category" class="form-select">
                                <option value="computer">Computer</option>
                                <option value="equipment">Equipment</option>
                                <option value="laboratory">Laboratory</option>
                                <option value="printers">Printers</option>
                                <option value="networking_equipment">Networking Equipment</option>
                                <option value="furniture">Furniture</option>
                                <option value="tools">Tools</option>
                            </select>
                        </div>
                    </div>
                    <!-- Budget -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label"><strong>Budget:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="budget" id="budget" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <!-- Vendor -->
                <div class="card-body">
                    <h4><strong>Vendor</strong></h4>
                    <!-- name -->
                    <div class="form-group row">
                        <label for="vendor_id" class="col-sm-2 col-form-label"><strong>Name:</strong></label>
                        <div class="col-sm-10">
                            <select name="vendor_id" id="vendor_id" class="form-select">
                                @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Responsible Faculty Member -->
                <div class="card-body">
                    <h4><strong>Responsible Faculty Member</strong></h4>
                    <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label"><strong>Username:</strong></label>
                        <div class="col-sm-10">
                            <select name="user_id" id="user_id" class="form-select">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- button -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-info" href="{{ url('Asset') }}"> Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection