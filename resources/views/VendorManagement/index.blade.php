@extends('VendorManagement.VendorLayout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Vendor</div>
                        <div class="card-body">
                            <a href="{{ url('/Vendor/create') }}" class="btn btn-success btn-sm" title="Add New Vendor">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vendor Name</th>
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $item)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $item->name}}</td>
                                            <td>{{ $item->contact}}</td>
                                            <td>
                                                <a href="{{ url('/VendorManagement/' .$item->id) }}" title="View Vendor"> <button class="btn btn-info btn-sm"> <i class="fa fa-eye" aria hidden="true"></i>View</button></a>
                                                <a href="{{ url('/VendorManagement/' .$item->id . '/edit') }}" title="Edit Vendor"> <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button> </a>
                                                <form method="POST" action="{{ url('/Vendor/' .$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Vendor" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
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
@endsection