@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Vendor Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('Vendor/'.$vendors->id) }}" method="post">
                        {!! csrf_field() !!}
                        @method("PATCH")
                        <label><h6>Name</h6></label>
                        <input type="text" name="name" id="name" value="{{$vendors->name}}" class="form-control" readonly></br>
                        <label><h6>Contact</h6></label></br>
                        <input type="text" name="contact" id="contact" value="{{$vendors->contact}}" class="form-control" readonly></br>
                        <label><h6>Email</h6></label></br>
                        <input type="text" name="email" id="email" value="{{$vendors->email}}" class="form-control" readonly></br>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-info" href="{{ url('VendorManagement') }}"> Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection