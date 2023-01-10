@extends('layouts.master')
@section('title')
Maintenance Management
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <h4 class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fs-4 bi bi-info-circle"></i> Maintenance Record
                    </div>
                </h4>
                <form action="" method="POST">
                    {{csrf_field()}}
                    @method("GET")
                    <div class="card-body">
                        <h4><strong>Maintenance</strong></h4>
                        <input type="hidden" name="id" id="id" class="form-control" value="{{$maintenances->id}}">
                        <!-- Serial Number -->
                        <div class="form-group row">
                            <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial
                                    Number:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="serial_number" id="serial_number"
                                    class="form-control-plaintext" value="{{$maintenances->serial_number}}" readonly>
                            </div>
                        </div>
                        <!-- Request Time -->
                        <div class="form-group row">
                            <label for="request_time" class="col-sm-2 col-form-label"><strong>Request
                                    Time:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="request_time" id="request_time" class="form-control-plaintext"
                                    value="{{$maintenances->request_time}}" readonly>
                            </div>
                        </div>
                        <!-- Approve Time -->
                        <div class="form-group row">
                            <label for="approve_time" class="col-sm-2 col-form-label"><strong>Approve
                                    Time:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="approve_time" id="approve_time" class="form-control-plaintext"
                                    value="{{$maintenances->approve_time}}" readonly>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label"><strong>Status:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="status" id="status" class="form-control-plaintext" value="@if($maintenances->status == 'Under Review')Under Review
                  @elseif($maintenances->status == 'Approved')Approved
                  @elseif($maintenances->status == 'Rejected')Rejected
                  @elseif($maintenances->status == 'Completed')Completed
                @elseif($maintenances->status == 'Cancelled')Cancelled
                  @else 
                  @endif" readonly>
                            </div>
                        </div>
                        <!-- Cost -->
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label"><strong>Cost:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="cost" id="cost" class="form-control-plaintext"
                                    value="{{$maintenances->cost}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- button -->
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-info" href="{{ url('MaintenanceManagement') }}"> Back</a>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection