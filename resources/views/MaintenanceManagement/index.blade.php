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
                    @if(Auth::check() && Auth::user()->role_as==1)
                    <a class="btn btn-secondary" title="Download as PDF" href="{{ URL::to('/maintenanceManagement/pdf') }}">
                        <i class="bi bi-file-pdf"></i> Download PDF</a>
                    @endif
                </div>
            </h4>
            <div class="card-body">
                <div class="row">
                    <!-- Search Bar -->
                    <div class="col col-md-auto">
                        <form action="/maintenanceManagement/search" method="GET">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" class="form-control" placeholder="Find serial number here"
                                        id='search_field' name="serial_number">
                                </div>
                                <!-- Search Bar -->
                                <!-- Search Bar Button-->
                                <button type="submit" class="btn btn-primary" title="Search Asset">
                                    <i class="bi bi-search"></i>
                                </button>
                                <!-- Search Bar Button-->
                            </div>
                        </form>
                    </div>
                    <!-- sort -->
                    <div class="col col-md-auto">
                        <form action="/MaintenanceManagement/sort" method="POST">
                            <div class="input-group">
                                @csrf
                                <!-- <label for="sort_category" class="form-control">Sort by:</label> -->
                                <select name="sort_category" id="sort_category" class="form-select">
                                    <option value="default_ol" @isset($sort_category) @if($sort_category=='default_ol' )
                                        selected @endif @endisset>Default (Oldest Created)</option>
                                    <option value="default_lo" @isset($sort_category) @if($sort_category=='default_lo' )
                                        selected @endif @endisset>Default (Latest Created)</option>
                                    <option value="serial_number" @isset($sort_category)
                                        @if($sort_category=='serial_number' ) selected @endif @endisset>Serial Number
                                    </option>
                                    <option value="status_a" @isset($sort_category) @if($sort_category=='status_a' )
                                        selected @endif @endisset>Status (Ascending Order)</option>
                                    <option value="status_d" @isset($sort_category) @if($sort_category=='status_d' )
                                        selected @endif @endisset>Status (Descending Order)</option>
                                    <option value="request_time" @isset($sort_category)
                                        @if($sort_category=='request_time' ) selected @endif @endisset>Request Time
                                    </option>
                                    <option value="approve_time" @isset($sort_category)
                                        @if($sort_category=='approve_time' ) selected @endif @endisset>Approve Time
                                    </option>
                                    <option value="cost" @isset($sort_category) @if($sort_category=='cost' ) selected
                                        @endif @endisset>Cost</option>
                                </select>
                                <button type="submit" class="btn btn-primary" title="Sort Maintenance">
                                    <i class="bi bi-sort-down-alt"></i> Sort by
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- filter -->
                    <div class="col col-md-auto">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFilter"
                            title="Filter Collapse" role="button" aria-expanded="false" aria-controls="collapseFilter">
                            <i class="bi bi-filter"></i> Filter by <i class="bi bi-arrows-collapse"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="collapseFilter">
                    <div class="card card-body">
                        <form action="/MaintenanceManagement/filter" method="POST">
                            @csrf
                            <!-- filter category -->
                            <div class="mb-3 row">
                                <label for="filter_category" class="col-sm-2 col-form-label">Filter by</label>
                                <div class="col-sm-10">
                                    <select name="filter_category" id="filter_category" class="form-select">
                                        <option value="status">Status</option>
                                    </select>
                                    <span id="filterCategoryHelpInline" class="form-text">
                                        Only status will be filtered.
                                    </span>
                                </div>
                            </div>
                            <!-- category -->
                            <div class="mb-3 row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-select">
                                        <option value="under_review">Under Review</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <!-- button -->
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" title="Filter Maintenance">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                        <th>Action</th>
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
                                                        title="View Record" class="btn btn-warning"><i
                                                            class="bi bi-eye"></i>
                                                        View</a>

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