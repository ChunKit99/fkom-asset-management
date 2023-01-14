@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Location Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('LocationManagement') }}" method="post">
                        {!! csrf_field() !!}
                        <label><h6>Location</h6></label></br>
                        <input type="text" name="name" id="name" class="form-control"></br>
                        <input type="submit" name="Save" class="btn btn-success"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection