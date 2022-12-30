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
    
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">Maintenance Management</div>
                    <div class="card-body">
                        <a href="{{ url('/MaintenanceManagement/create') }}" class="btn btn-success btn-sm" title="Add New Maintenance Request">
                            <i class="bi bi-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
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
                                <tbody>
                                @foreach($maintenances as $maintenance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $maintenance->serial_number }}</td>
                                        <td>{{ $maintenance->request_time }}</td>
                                        <td>{{ $maintenance->approve_time }}</td>
                                        <td>{{ $maintenance->status }}</td>
                                        <td>{{ $maintenance->cost }}</td>
                                        <td>
                                            <a href="{{ url('/MaintenanceManagement/' . $maintenance->id) }}" title="View Lecturer"><button class="btn btn-info btn-sm"><i class="bi bi-eye" aria-hidden="true"></i> View</button></a>
                                            <form method="POST" action="{{ url('/MaintenanceManagement' . '/' . $maintenance->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Lecturer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection