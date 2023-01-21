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
                        <i class="bi bi-cash-coin"></i><a href="{{ url('/Budget') }} "class="link-dark text-decoration-none"> Budget</a>
                        </div>
                        <div class="btn-group" role="group" aria-label="button group">
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
                                                <th>Status</th>  
                                                <!--Admin Action-->
                                                <th>Action</th>  
                                                <!--User Request-->
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
                                                    <!--category -->
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
                                                    <!--Status-->
                                                    <td>{{ $asset->status }}</td>
                                                    <!--Admin Edit Button-->   
                                                    <td>
                                                    <a href="{{ url('/Budget/' . $asset->id . '/edit') }}" title="Edit Budget" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
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