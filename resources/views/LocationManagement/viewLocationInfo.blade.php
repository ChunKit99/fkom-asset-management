@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">Location Information</div>
    <div class="card-body">
        <form action="{{ url('Location/'.$location->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            
            <input type="text" name="id" id="id" value="{{$location->id}}" id="id" class="form-control" readonly> <br>
            <label>Location</label>
            <input type="text" name="name" id="name" value="{{$location->name}}" class="form-control" readonly></br>
            <a href="{{ url('LocationManagement') }}" title="Back" class="btn btn-info"> Back </a><br>

        </form>
    </div>
</div>


@endsection