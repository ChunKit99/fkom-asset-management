@extends('layout')
@section('title')
Add Maintenance Record
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                <i class="bi bi-file-earmark-plus"></i> Add Maintenance Record
                </div>
            </h4>
            <div class="card-body">
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
                <form action="{{ url('MaintenanceManagement') }}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Serial Number:</strong>
                                <select name="serial_number" id="serial_number" class="form-control">
                                    @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->serial_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Location:</strong>
                                <select selected disabled name="location_id" id="location_id" class="form-control">
                                    @foreach($locations as $location)
                                    <option value="{{ $asset->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>Category:</strong>
                            <select selected disabled name="category" id="category" class="form-control">
                                <option value="computer">Computer</option>
                                <option value="equipment">Equipment</option>
                                <option value="laboratory">Laboratory</option>
                                <option value="printers">Printers</option>
                                <option value="networking_equipment">Networking Equipment</option>
                                <option value="furniture">Furniture</option>
                                <option value="tools">Tools</option>
                            </select>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Budget:</strong>
                                <select selected disabled name="budget" id="budget" class="form-control">
                                    @foreach($assets as $asset)
                                    <option value="{{ $asset->budget }}">{{ $asset->budget }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Vendor:</strong>
                                <select selected disabled name="vendor_id" id="vendor_id" class="form-control">
                                    @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Responsible Faculty Members:</strong>
                                <select selected disabled name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-info" href="{{ url('maintenanceManagement/list') }}"> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection