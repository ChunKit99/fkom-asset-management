@extends('AssetManagement.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 mx-auto">
      <div class="card">
        <h4 class="card-header d-flex justify-content-between align-items-center">
          <div>
            <i class="fas fa-book"></i> Asset Information
          </div>
        </h4>
        <div class="card-body">
          <form action="" method="POST">
            {{csrf_field()}}
            @method("GET")
            <div class="row">
              <input type="hidden" name="id" id="id" class="form-control" value="{{$asset->id}}">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Serial Number:</strong>
                  <input type="text" name="serial_number" id="serial_number" class="form-control-plaintext" value="{{$asset->serial_number}}" readonly>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Location:</strong>
                  <input type="text" name="location" id="location" class="form-control-plaintext" value="{{$asset->location}}" readonly>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Category:</strong>
                  <input type="text" name="category" id="category" class="form-control-plaintext" value="{{$asset->category}}" readonly>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Budget:</strong>
                  <input type="text" name="budget" id="budget" class="form-control-plaintext" value="{{$asset->budget}}" readonly>
                </div>
              </div>
              <h4><strong>Vendor:</strong></h4>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Name:</strong>
                  <input type="text" name="vendor_name" id="vendor_name" class="form-control-plaintext" value="{{ $vendor->name }}" readonly>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Name:</strong>
                  <input type="text" name="vendor_name" id="vendor_name" class="form-control-plaintext" value="{{ $vendor->name }}" readonly>
                </div>
              </div>
              <h4><strong>Responsible Faculty Member:</strong></h4>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Name:</strong>
                  <input type="text" name="user_name" id="user_name" class="form-control-plaintext" value="{{ $user->name }}" readonly>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-info" href="{{ url('Asset') }}"> Back</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


