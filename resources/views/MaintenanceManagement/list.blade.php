@extends('layout')
@section('title')
Add Maintenance List
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fal fa-coins"></i> <a href="{{ url('/MaintenanceManagement') }} "
                        class="link-dark text-decoration-none">Maintenance List</a>
                </div>
                <div class="btn-group" role="group" aria-label="button group">
                    <a class="btn btn-success" title="New Maintenance" href="{{ url('/MaintenanceManagement/') }}">
                        <i class="bi bi-plus-circle"></i> Back</a>
                </div>
            </h4>
            <div class="card-body">
                <section>
                    <div class="table-responsive text-nowrap">
                        <!--Table-->
                        <table class="table table-striped text-center">
                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial Number</th>
                                    <th>Category</th>
                                    <th>Budget</th>
                                    <th>Location</th>
                                    <th>Vendor Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                                @foreach ($assets as $asset)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ $asset->category }}</td>
                                    <td>{{ $asset->budget }}</td>
                                    <td>{{ $asset->location }}</td>
                                    <td>{{ $asset->vendor }}</td>
                                    <td>
                                        <!-- View Edit Delete Button -->
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="button group">
                                                <form action="{{ url('MaintenanceManagement') }}" method="POST">
                                                    {{csrf_field()}}
                                                    <input name="serial_number" id="serial_number" hidden class="form-control"
                                                        value="{{ $asset->serial_number }}"></input>
                                                    <input name="request_time" id="request_time" hidden class="form-control"
                                                        value=""></input>
                                                    <input name="status" id="status" hidden class="form-control"
                                                        value=""></input>
                                                    <button type="submit" class="btn btn-primary">Add Request</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection