@extends('layouts.master')
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
            <h4 class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fal fa-coins"></i> <a href="{{ url('/MaintenanceManagement') }} "
                        class="link-dark text-decoration-none">Maintenance Management</a>
                </div>
                <div class="btn-group" role="group" aria-label="button group">
                    <a class="btn btn-success" title="New Maintenance"
                        href="{{ url('/maintenanceManagement/list') }}">
                        <i class="bi bi-plus-circle"></i> Create New Maintenance</a>
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
                                    <th>Request Time</th>
                                    <th>Approve Time</th>
                                    <th>Status</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $maintenance->serial_number }}</td>
                                    <td>{{ $maintenance->request_time }}</td>
                                    <td>{{ $maintenance->approve_time }}</td>
                                    <td>
                                        <!--Category-->
                                        @if($maintenance->status == 'Under Review')
                                        Under Review
                                        @elseif($maintenance->status == 'Approved')
                                        Approved
                                        @elseif($maintenance->status == 'Rejected')
                                        Rejected
                                        @else
                                        @endif
                                    </td>
                                    <td>{{ $maintenance->cost }}</td>
                                    <td>
                                        <!-- View Edit Delete Button -->
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="button group">
                                                <a href="{{ url('/MaintenanceManagement/' . $maintenance->id) }}" title="View Record"
                                                    class="btn btn-primary">View</a>
                                                <a href="{{ url('/MaintenanceManagement/' . $maintenance->id . '/edit') }}" title="Edit Record"
                                                    class="btn btn-warning">Edit</a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    title="Delete Record"
                                                    data-bs-target="#confirmDelete{{$loop->iteration}}">
                                                    Delete
                                                </button>
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
                                                            <strong>Serial Number: </strong>{{$maintenance->serial_number}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ url('/MaintenanceManagement' . '/' . $maintenance->id)}}"
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