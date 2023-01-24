@extends($layout)
@section('title')
Maintenance Cost
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
                        class="link-dark text-decoration-none">Maintenance Cost</a>
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
                                    <td>
                                        <form action="{{ url('maintenanceManagement/submitCost') }}" method="GET">
                                            {{csrf_field()}}
                                            <input name="cost" id="cost" class="form-control"
                                                value=""></input>
                                    </td>
                                    <td>
                                        <!-- View Edit Delete Button -->
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="button group">
                                                    <input hidden name="maintenance_id" id="maintenance_id"
                                                        class="form-control" value="{{ $maintenance->id }}"></input>
                                                    <input hidden name="serial_number" id="serial_number"
                                                        class="form-control"
                                                        value="{{ $maintenance->serial_number }}"></input>
                                                    <button type="submit" class="btn btn-primary">Add Cost</button>
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