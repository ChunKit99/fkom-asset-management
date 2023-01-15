@extends($layout)
@section('title')
BudgetManagement
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
                        <i class="bi bi-cash-coin"></i><a href="{{ url('/Budget') }} "class="link-dark text-decoration-none"> Budget</a>
                        </div>
                        <div class="btn-group" role="group" aria-label="button group">
                            <!-- View Budget Report--> 
                            @if(Auth::check() && Auth::user()->role_as==1) 
                        <a class="btn btn-success" title="View Report" href="{{ url('/Budget/show') }}">
                            <i class="bi bi-eye"></i> View Report</a>
                            @endif
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
                                                <th>Budget</th>
                                                <th>Status</th>  
                                                <!--Admin Action-->
                                                @if(Auth::check() && Auth::user()->role_as==1) 
                                                <th>Action</th>  
                                                @endif
                                                <!--User Request-->
                                                @if(Auth::check() && Auth::user()->role_as==0)
                                                <th>Request</th> 
                                                @endif
                                            </tr>
                                        </thead>
                                        <!--Table head-->
                                        <!--Table body-->
                                        <tbody>
                                            @foreach($assets as $asset)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <!--Location Name-->
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
                                                    <!--Budget-->
                                                    <td>{{ $asset->budget }}</td>
                                                    <!--Budget Status-->
                                                    <td>
                                                        <!--Computer-->
                                                        @if($asset->category == 'computer' && $asset->budget > 500)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'computer' && $asset->budget <= 500)
                                                        <span class="badge bg-success">Good</span>
                                                        <!--Equipment-->
                                                        @elseif($asset->category == 'equipment' && $asset->budget > 600)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'equipment' && $asset->budget <= 600)
                                                        <span class="badge bg-success">Good</span>
                                                        <!--Laboratory-->
                                                        @elseif($asset->category == 'laboratory' && $asset->budget > 300)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'laboratory' && $asset->budget <= 300)
                                                        <span class="badge bg-success">Good</span>
                                                        <!--Printer-->
                                                        @elseif($asset->category == 'printers' && $asset->budget > 200)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'printers' && $asset->budget <= 200)
                                                        <span class="badge bg-success">Good</span>     
                                                        <!--Network Equipment-->
                                                        @elseif($asset->category == 'networking_equipment' && $asset->budget > 500)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'networking_equipment' && $asset->budget <= 500)
                                                        <span class="badge bg-success">Good</span>   
                                                        <!--Furniture-->
                                                        @elseif($asset->category == 'furniture' && $asset->budget > 400)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'furniture' && $asset->budget <= 400)
                                                        <span class="badge bg-success">Good</span>    
                                                        <!--Tool-->
                                                        @elseif($asset->category == 'tools' && $asset->budget > 100)
                                                        <span class="badge bg-danger">Bad</span>
                                                        @elseif($asset->category == 'tools' && $asset->budget <= 100)
                                                        <span class="badge bg-success">Good</span>          
                                                        @else
                                                        @endif
                                                    </td>
                                                    <!--Admin Edit Button-->   
                                                    @if(Auth::check() && Auth::user()->role_as==1) 
                                                    <td>
                                                    <a href="{{ url('/Budget/' . $asset->id . '/edit') }}" title="Edit Budget" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                                                    </td>
                                                    @endif
                                                    <!--User Request Button-->  
                                                    @if(Auth::check() && Auth::user()->role_as==0) 
                                                    <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="btn-group" role="group" aria-label="button group">
                                                            <form action="{{ url('Budget') }}" method="POST">
                                                                {{csrf_field()}}
                                                                <input name="serial_number" id="serial_number" hidden class="form-control"
                                                                    value="{{ $asset->serial_number }}"></input>
                                                                <input name="status" id="status" hidden class="form-control"
                                                                    value=""></input>
                                                                <button type="submit" class="btn btn-primary">Add Request</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection