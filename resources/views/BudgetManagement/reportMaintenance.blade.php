@extends('layouts.master')
@section('title')
BudgetManagement
@endsection

@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
                <div class="card">
                    <h4 class="card-header d-flex justify-content-between align-items-center">
                        <div>
                        <i class="bi bi-cash-coin"></i><a href="{{ url('/Budget') }} "class="link-dark text-decoration-none"> View Maintenance Report</a>
                        </div>
                        <div class="btn-group" role="group" aria-label="button group">
                        <a class="btn btn-secondary" title="Download as CSV" href="{{ route('budget.exportcsv1') }}">
                        <i class="bi bi-file-earmark-excel-fill"></i> Download CSV</a>
                        </div>
                    </h4>   
                          <div class="table-responsive text-nowrap">
                                    <table class = "table table-striped text-center">
                                        <!--Table head-->
                                        <thead>
                                            <tr> 
                                                <th>#</th>
                                                <th>Serial Number</th>
                                                <th>Category</th>
                                                <th>History</th> 
                                                <th>Cost</th> 
                                                <th>Status</th> 
                                            </tr>
                                        </thead>
                                        <!--Table head-->
                                        <!--Table body-->
                                        <tbody>
                                            @foreach($assets as $asset)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <!--Serial Number -->
                                                    <td>{{ $asset->serial_number }}</td>
                                                    <td>
                                                        <!--Category-->
                                                        @if($asset->category == 'computer')
                                                        Computer
                                                        @elseif($asset->category == 'equipment')
                                                        Equipment
                                                        @elseif($asset->category == 'laboratory')
                                                        Laboratory
                                                        @elseif($asset->category == 'printers')
                                                        Printers
                                                        @elseif($asset->category == 'networking_equipment')
                                                        Networking Equipment
                                                        @elseif($asset->category == 'furniture')
                                                        Furniture
                                                        @elseif($asset->category == 'tools')
                                                        Tools
                                                        @else
                                                        @endif
                                                    </td>
                                                    <!--Time Maintenance-->
                                                    <td>{{ $asset->approve_time }}</td>
                                                    <!--Maintenance cost-->
                                                    <td>{{ $asset->cost }}</td>
                                                    <!--Status-->  
                                                    <td>{{ $asset->status }}</td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection