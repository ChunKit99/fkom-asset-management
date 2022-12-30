@extends('layout')
@section('title')
Maintenance Management
@endsection
@section('content')
<div class="row">
  <div class="col-md-11 mx-auto">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p>{{ $message }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($message = Session::get('warning'))
    <div class="alert alert-warning  alert-dismissible fade show" role="alert">
      <p>{{ $message }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card">
        <div class="card-header">Maintenance Record
            <a href="{{ url('/MaintenanceManagement') }}" class="panel-right btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="https://fk.ump.edu.my/images/logoresearchgroup/gambar-pensyarah/zulfahmi-2.png" class="img-thumbnail" alt="...">
                </div>
                <div class="col">
                    <form action="{{ url('MaintenanceManagement/') }}" method="POST">
                        {!! csrf_field() !!}
                        <label>ID</label></br>
                        <input type="text" name="id" id="id" value="{{$maintenances->id}}" class="form-control" readonly></br>
                        <label>Serial Number</label></br>
                        <input type="text" name="name" id="name" value="{{$maintenances->serial_number}}" class="form-control" readonly></br>
                        <label>Request Time</label></br>
                        <input type="text" name="address" id="authaddressor" value="{{$maintenances->request_time}}" class="form-control" readonly></br>
                        <label>Approve Time</label></br>
                        <input type="text" name="department" id="department" value="{{$maintenances->approve_time}}" class="form-control" readonly></br>
                        <label>Status</label></br>
                        <input type="text" name="formeh" id="formeh" value="{{$maintenances->status}}" class="form-control" readonly></br>
                        <label>Cost</label></br>
                        <input type="text" name="formeh" id="formeh" value="{{$maintenances->cost}}" class="form-control" readonly></br>
                    </form>
                    <a href="{{ url('/MaintenanceManagement/') }}" title="Cancel"><button class="btn btn-secondary">
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>

  .panel-right {

    float: right;

  }

</style>