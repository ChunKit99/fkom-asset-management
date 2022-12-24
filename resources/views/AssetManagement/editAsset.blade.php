@extends('AssetManagement.layout')
@section('content')
<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fal fa-coins"></i> Asset Information Edit
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
                <form action="{{ url('Asset/' . $asset->id) }}" method="POST">
                    {{csrf_field()}}
                    @method("PATCH")
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$asset->id}}">
                            <div class="form-group">
                                <strong>Serial Number:</strong>
                                <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{$asset->serial_number}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Location:</strong>
                                <input type="text" name="location" id="location" class="form-control" value="{{$asset->location}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>Category:</strong>
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

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Budget:</strong>
                                <input type="text" name="year" id="year" class="form-control" value="{{$asset->budget}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Vendor:</strong>
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ $vendor->id == $asset->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Responsible Faculty Members:</strong>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $asset->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-info" href="{{ url('Asset') }}"> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection