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
                        <h4><strong>Maintenance Record</strong></h4>
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
                                <input type="text" name="status" id="status" class="form-control-plaintext" value="@if($maintenances->status == 'under_review')Under Review
                  @elseif($maintenances->status == 'approved')Approved
                  @elseif($maintenances->status == 'rejected')Rejected
                  @elseif($maintenances->status == 'completed')Completed
                @elseif($maintenances->status == 'cancelled')Cancelled
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
                        <h4><strong>Asset</strong></h4>
                        <!-- Serial Number -->
                        <div class="form-group row">
                            <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial
                                    Number:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="serial_number" id="serial_number"
                                    class="form-control-plaintext" value="{{$assets->serial_number}}" readonly>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label"><strong>Location:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="location" id="location" class="form-control-plaintext"
                                    value="{{$location->name}}" readonly>
                            </div>
                        </div>
                        <!-- category -->
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label"><strong>Category:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="category" id="category" class="form-control-plaintext" value="@if($assets->category == 'computer')Computer
                  @elseif($assets->category == 'equipment')Equipment
                  @elseif($assets->category == 'laboratory')Laboratory
                  @elseif($assets->category == 'printers')Printers
                  @elseif($assets->category == 'networking_equipment')Networking Equipment  
                  @elseif($assets->category == 'furniture')Furniture
                  @elseif($assets->category == 'tools')Tools
                  @else 
                  @endif" readonly>
                            </div>
                        </div>
                        <!-- Budget -->
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label"><strong>Budget:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="budget" id="budget" class="form-control-plaintext"
                                    value="{{$assets->budget}}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Vendor -->
                    <div class="card-body">
                        <h4><strong>Vendor</strong></h4>
                        <!-- name -->
                        <div class="form-group row">
                            <label for="vendor_name" class="col-sm-2 col-form-label"><strong>Name:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_name" id="vendor_name" class="form-control-plaintext"
                                    value="{{$vendor->name}}" readonly>
                            </div>
                        </div>
                        <!-- contact -->
                        <div class="form-group row">
                            <label for="vendor_contact"
                                class="col-sm-2 col-form-label"><strong>Contact:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_contact" id="vendor_contact"
                                    class="form-control-plaintext" value="{{$vendor->contact}}" readonly>
                            </div>
                        </div>
                        <!-- email -->
                        <div class="form-group row">
                            <label for="vendor_email" class="col-sm-2 col-form-label"><strong>Email:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="vendor_email" id="vendor_email" class="form-control-plaintext"
                                    value="{{$vendor->email}}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Responsible Faculty Member -->
                    <div class="card-body">
                        <h4><strong>Responsible Faculty Member</strong></h4>
                        <!-- user name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-sm-2 col-form-label"><strong>Username:</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="user_name" id="user_name" class="form-control-plaintext"
                                    value="{{$user->name}}" readonly>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card-body">
                <!-- button -->
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-info" href="{{ url('MaintenanceManagement') }}"><i
                            class="bi bi-arrow-90deg-up"></i> Back</a>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection