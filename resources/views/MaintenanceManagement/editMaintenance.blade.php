@extends('layouts.master')
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
                        <label for="serial_number" class="col-sm-2 col-form-label"><strong>Serial
                                Number:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="serial_number" id="serial_number" class="form-control"
                                value="{{$maintenances->serial_number}}" readonly>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="form-group row">
                        <label for="serial_number" class="col-sm-2 col-form-label"><strong>Status:</strong></label>
                        <div class="col-sm-10">
                            <!-- <input type="text" name="status" id="status" class="form-control"
                                value="{{$maintenances->status}}" readonly> -->
                            <select name="status" id="status" disabled class="form-select">
                            <option value="under_review" {{ $maintenances->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="approved" {{ $maintenances->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $maintenances->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ $maintenances->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $maintenances->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <!-- Cost -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label"><strong>Cost:</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="cost" id="cost" class="form-control"
                                value="{{$maintenances->cost}}">
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