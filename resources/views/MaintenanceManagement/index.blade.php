@extends($layout)
@section('title')
Maintenance Record
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
                        class="link-dark text-decoration-none">Maintenance Record</a>
                </div>
                <div class="btn-group" role="group" aria-label="button group">
                    @if(Auth::check() && Auth::user()->role_as==0)
                    <a class="btn btn-success" title="New Maintenance" href="{{ url('/maintenanceManagement/list') }}">
                        <i class="bi bi-plus-circle"></i> Create New Maintenance</a>
                    @endif
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
                                        @if($maintenance->status == 'under_review')
                                        Under Review
                                        @elseif($maintenance->status == 'approved')
                                        Approved
                                        @elseif($maintenance->status == 'rejected')
                                        Rejected
                                        @elseif($maintenance->status == 'completed')
                                        Completed
                                        @elseif($maintenance->status == 'cancelled')
                                        Cancelled
                                        @else
                                        @endif
                                    </td>
                                    <td>{{ $maintenance->cost }}</td>
                                    <td>
                                        <!-- View Edit Delete Button -->
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="button group">
                                                <a href="{{ url('/MaintenanceManagement/' . $maintenance->id) }}"
                                                    title="View Record" class="btn btn-primary">View</a>
                                                
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