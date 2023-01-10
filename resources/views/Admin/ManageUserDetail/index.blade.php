@extends('layouts.master')
@section('title', 'Manage User Information')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card card text-center">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <!--Add button to addbook interface-->

                    <style>
                    .content {
                        position: relative;
                    }

                    #right-panel-link {
                        position: absolute;
                        top: 0;
                        right: 0;
                    }
                    </style>

                    <a href="{{ url('/Admin/ManageUserDetail/create') }}" class="btn btn-primary pull-right" id="right-panel-link"
                        href="#right-panel"><i class="bi bi-eye" aria-hidden="true"></i> Add New</a>

                    <!--overall view table-->
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr class="table-info">
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Location</th>
                                    <th scope="col"></th>
                                    <th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--loop all data out -->
                                @foreach($user as $item)
                                
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item -> name}}</td>
                                    <td>{{$item -> username}}</td>
                                    <td>{{$item -> contact}}</td>
                                    <td>{{$item -> position}}</td>
                                    <td>{{$item -> department}}</td>
                                    <td>{{$item -> location}}</td>
                                    <td>

                                        <!-- view button -->
                                        <a href="{{ url('Admin/ManageUserDetail/' . $item->id) }}" title="View"><button
                                                class="btn btn-info"><i class="bi bi-eye"
                                                    aria-hidden="true"></i>View</button></a>
                                        <!-- edit button -->
                                        <a href="{{ url('/Admin/ManageUserDetail/' . $item->id . '/edit') }}" title="Edit"><button
                                                class="btn btn-warning"><i class="bi bi-pencil-square"
                                                    aria-hidden="true">
                                                </i>Edit</button></a>
                                        <!-- delete button -->
                                        <form method="post" action="{{ url('/Admin/ManageUserDetail' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{  csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Delete"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="bi bi-trash" aria-hidden="true"></i>Delete</button>
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



@endsection