@extends('layouts.master')
@section('title', 'Manage User Profile')
@section('content')
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card card text-center">
                <div class="card-header">User Information</div>
                <div class="card-body">

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

                    <!--overall view table-->
                    <div class="table-responsive, text-start">
                        <table class="table">
                            <tbody>
                                <!--loop all data out -->
                                @foreach($user as $item)
                                <tr>
                                    <th scope="col">Name</th>
                                    <td>{{$item -> fullname}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Username</th>
                                    <td>{{$item -> username}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Email Address</th>
                                    <td>{{$item -> useremail}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Contact Number</th>
                                    <td>{{$item -> contact}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Position</th>
                                    <td>{{$item -> position}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Department</th>
                                    <td>{{$item -> department}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Location</th>
                                    <td>{{$item -> location}}</td>
                                </tr>

                                <!-- edit button -->
                                <div class="btn-group" role="group" id="right-panel-link"
                                            href="#right-panel">

                                    <a href="{{ url('/manageUserProfile/editPassword/' . $item->id) }}"
                                        title="Edit"><button class="btn btn-primary"><i class="bi bi-pencil-square" aria-hidden="true">
                                            </i>Account Settings</button></a>

                                    <a href="{{ url('/ManageUserProfile/' . $item->id . '/edit') }}"
                                        title="Edit"><button class="btn btn-warning" ><i class="bi bi-pencil-square" aria-hidden="true">
                                            </i>Edit</button></a>
                                </div>

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