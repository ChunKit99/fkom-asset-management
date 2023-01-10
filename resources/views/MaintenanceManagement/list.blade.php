@extends('layouts.master')
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
                    <a class="btn btn-success" title="New Maintenance"
                        href="{{ url('/MaintenanceManagement/') }}">
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
                                                <a href="{{ url('/MaintenanceManagement/create') }}" title="Add Record"
                                                    class="btn btn-warning">Add Request</a>
                                            </div>
                                            <!-- View Edit Delete Button -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmDelete{{$loop->iteration}}" tabindex="-1"
                                                aria-labelledby="confirmDelete{{$loop->iteration}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Record</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure to delete?</p>
                                                            <strong>Serial Number: </strong>{{$asset->serial_number}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ url('/MaintenanceManagement' . '/' . $asset->id)}}"
                                                                method="POST" style="width:fit-content">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    title="Delete Record">Delete</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Modal  -->
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