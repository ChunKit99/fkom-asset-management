@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Location Information Edit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('LocationManagement/'.$location->id) }}" method="post">
                        {!! csrf_field() !!}
                        @method("PATCH")

                        <input type="hidden" name="id" id="id" value="{{$location->id}}" id="id">
                        <label><h6>Location</h6></label>
                        <input type="text" name="name" id="name" value="{{$location->name}}" class="form-control"></br>
                        <input type="submit" value="Update" class="btn btn-success"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection