@extends('layouts.master')
@section('title', 'Add User Account')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>Add User Infomation</b></div>
            <div class="card-body">
                <form action="{{ url('Admin/ManageUserAccount') }}" method="post">
                    {!! csrf_field() !!}
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" class="form-control">
                    <label>Email Address</label>
                    <br>
                    <input type="text" name="email" id="email" class="form-control">
                    <label>Password</label>
                    <br>
                    <input type="text" name="password" id="password" class="form-control">
                    <br>

                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                                <input type="submit" value="Save" class="btn btn-success">
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