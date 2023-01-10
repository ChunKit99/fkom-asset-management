@extends('layouts.master')
@section('title', 'Edit Admin Account')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>Edit Admin Account</b></div>
            <div class="card-body">
                <form action="{{ url('Admin/manageAdminProfile/updatePassword/'.$user->id)}}" method="post">
                    {{csrf_field()}}
                    <!-- @method("PATCH") -->
                    <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id">
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" readonly>
                    <label>Email Address</label>
                    <br>
                    <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control">
                    <label>Password</label>
                    <br>
                    <input type="text" name="password" id="password" value="{{$user->password}}" class="form-control">
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection