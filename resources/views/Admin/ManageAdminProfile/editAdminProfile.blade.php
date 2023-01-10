@extends('layouts.master')
@section('title', 'Edit Admin Profile')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>Edit Admin Information</b></div>
            <div class="card-body">
                <form action="{{ url('Admin/ManageAdminProfile/'.$admin->id) }}" method="post">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <input type="hidden" name="id" id="id" value="{{$admin->id}}" id="id">
                    <label>Name</label>
                    <br>
                    <input type="text" name="fullname" id="fullname" value="{{$admin->fullname}}" class="form-control">
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$admin->name}}" class="form-control"
                        readonly>
                    <label>Contact Number</label>
                    <br>
                    <input type="text" name="contact" id="contact" value="{{$admin->contact}}" class="form-control">
                    <label>Position</label>
                    <br>
                    <input type="text" name="position" id="position" value="{{$admin->position}}"
                        class="form-control">
                    <label>Position</label>
                    <br>
                    <input type="text" name="department" id="department" value="{{$admin->department}}"
                        class="form-control">
                    <label>Department</label>
                    <br>
                    <input type="text" name="location" id="location" value="{{$admin->location}}"
                        class="form-control">
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                                <input type="submit" value="Update" class="btn btn-success">
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