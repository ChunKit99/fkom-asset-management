@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">Location Information Edit</div>
    <div class="card-body">
        <form action="{{ url('LocationManagement/'.$location->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            
            <input type="hidden" name="id" id="id" value="{{$location->id}}" id="id">
            <label>Location</label>
            <input type="text" name="name" id="name" value="{{$location->name}}" class="form-control"></br>
            <input type="submit" value="Update" class="btn btn-success"></br>
        </form>
    </div>
</div>


@endsection