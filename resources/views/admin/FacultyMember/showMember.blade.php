@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>Edit User Information</b></div>
            <div class="card-body">
                <form action="{{ url('FacultyMember/'.$members->id) }}" method="post">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <input type="hidden" name="id" id="id" value="{{$members->id}}" id="id">
                    <label>Name</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$members->name}}" class="form-control" readonly>
                    <label>Username</label>
                    <br>
                    <input type="text" name="username" id="username" value="{{$members->username}}" class="form-control" readonly>
                    <label>Contact Number</label>
                    <br>
                    <input type="text" name="contact" id="contact" value="{{$members->contact}}" class="form-control" readonly>
                    <label>Position</label>
                    <br>
                    <input type="text" name="position" id="position" value="{{$members->position}}" class="form-control" readonly>
                    <label>Position</label>
                    <br>
                    <input type="text" name="department" id="department" value="{{$members->department}}" class="form-control" readonly>
                    <label>Department</label>
                    <br>
                    <input type="text" name="location" id="location" value="{{$members->location}}" class="form-control" readonly>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                                
                            <a href="{{ url('/FacultyMember') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Back</a>
                            </div>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection