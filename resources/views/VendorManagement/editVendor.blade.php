@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Vendor Information Edit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('VendorManagement/'.$vendors->id) }}" method="post">
                        {!! csrf_field() !!}
                        @method("PATCH")

                        <input type="hidden" name="id" id="id" value="{{$vendors->id}}" id="id">
                        <label><h6>Name</h6></label>
                        <input type="text" name="name" id="name" value="{{$vendors->name}}" class="form-control"></br>
                        <label><h6>Contact</h6></label></br>
                        <input type="text" name="contact" id="contact" value="{{$vendors->contact}}" class="form-control"></br>
                        <label><h6>Email</h6></label></br>
                        <input type="text" name="email" id="email" value="{{$vendors->email}}" class="form-control"></br>
                        <input type="submit" value="Update" class="btn btn-success"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection