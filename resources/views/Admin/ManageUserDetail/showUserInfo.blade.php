@extends('layouts.master')
@section('title', 'Show User Information')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>User Information</b></div>
            <div class="card-body">
                <form action="{{ url('Admin/ManageUserDetail/'.$user->id) }}" method="post">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id">
                    <label>Name</label>
                    <br>
                    <input type="text" name="fullname" id="fullname" value="{{$user->fullname}}" class="form-control" readonly>
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" readonly>
                    <label>Contact Number</label>
                    <br>
                    <input type="text" name="contact" id="contact" value="{{$user->contact}}" class="form-control" readonly>
                    <label>Position</label>
                    <br>
                    <input type="text" name="position" id="position" value="{{$user->position}}" class="form-control" readonly>
                    <label>Position</label>
                    <br>
                    <input type="text" name="department" id="department" value="{{$user->department}}" class="form-control" readonly>
                    <label>Department</label>
                    <br>
                    <input type="text" name="location" id="location" value="{{$user->location}}" class="form-control" readonly>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                            <a href="{{ url('/Admin/ManageUserDetail') }}" class="btn btn-primary  active" role="button" aria-pressed="true">Back</a>
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