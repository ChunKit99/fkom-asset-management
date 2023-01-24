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
                    <form action="{{ url('VendorManagement') }}" method="post">
                        {!! csrf_field() !!}
                        <label><h6>Name</h6></label></br>
                        <input type="text" name="name" id="name" class="form-control"></br>
                        <label><h6>Contact</h6></label></br>
                        <input type="text" name="contact" id="contact" class="form-control"></br>
                        <label><h6>Email</h6></label></br>
                        <input type="text" name="email" id="email" class="form-control"></br>
                        <input type="submit" name="Save" class="btn btn-success"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection