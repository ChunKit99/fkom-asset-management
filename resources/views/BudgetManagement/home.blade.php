@extends('layout')
@section('title')
BudgetManagement
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
                <div class="card">
                    <h4 class="card-header d-flex justify-content-between align-items-center">
                        <div>
                        <i class="fal fa-coins"></i> <a href="{{ url('/Budget') }} "class="link-dark text-decoration-none">Budget</a>
                        </div>
                        <div class="btn-group" role="group" aria-label="button group">
                        <a class="btn btn-success" title="View Report" href="{{ url('/Budget/show') }}">
                            <i class="bi bi-eye"></i> View Report</a>
                        </div>
                    </h4>
                        <div class = "card-body">                    
                            <div class="table-responsive text-nowrap">
                                <table class = "table table-striped text-center">
                                    <thead>
                                        <tr> 
                                            <th>#</th>
                                            <th>Serial Number</th>
                                            <th>Budget</th>
                                            <th>Status</th>   
                                            <th>Action</th>               
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($assets as $asset)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $asset->serial_number }}</td>
                                                <td>{{ $asset->budget }}</td>
                                                <td>
                                                    @if($asset->budget > 300)
                                                    <span class="badge bg-success">Good</span>
                                                    @elseif ($asset->budget <= 300)
                                                    <span class="badge bg-danger">Bad</span>
                                                    @else
                                                    @endif
                                                </td>

                                                <td>
                                                <a href="{{ url('/Budget/' . $asset->id . '/edit') }}" title="Edit Budget" class="btn btn-warning">Edit</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection