@extends('LocationManagement.LocationLayout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Location</div>
                        <div class="card-body">
                            <a href="{{ url('/LocationManagement/create') }}" class="btn btn-success btn-sm" title="Add New Location">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($location as $item)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $item->name}}</td>
                                            <td>
                                                <a href="{{ url('/LocationManagement/' .$item->id) }}" title="View Location"> <button class="btn btn-info btn-sm"> <i class="fa fa-eye" aria hidden="true"></i>View</button></a>
                                                <a href="{{ url('/LocationManagement/' .$item->id . '/edit') }}" title="Edit Location"> <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button> </a>
                                                <form method="POST" action="{{ url('/LocationManagement/' .$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Location" onclick="return confirm(&quot;Confirm delete?&quot;)">
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