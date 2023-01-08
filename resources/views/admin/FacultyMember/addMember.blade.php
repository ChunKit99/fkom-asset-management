@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>Add User Infomation</b></div>
            <div class="card-body">
                <form action="{{ url('FacultyMember') }}" method="post">
                    {!! csrf_field() !!}
                    <label>Name</label>
                    <br>
                    <input type="text" name="name" id="name" class="form-control">

                    <label>Username</label>
                    <br>
                    <select name="username" id="username" class="form-control">
                        @foreach($users as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label>Contact Number</label>
                    <br>
                    <input type="text" name="contact" id="contact" class="form-control">
                    <label>Position</label>
                    <br>
                    <input type="text" name="position" id="position" class="form-control">
                    <label>Department</label>
                    <br>
                    <input type="text" name="department" id="department" class="form-control">
                    <label>Location</label>
                    <br>
                    <input type="text" name="location" id="location" class="form-control">
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