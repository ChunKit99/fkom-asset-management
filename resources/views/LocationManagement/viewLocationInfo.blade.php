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
                    <form action="{{ url('Location/'.$location->id) }}" method="post">
                        {!! csrf_field() !!}
                        @method("PATCH")

                        <label><h6>Location</h6></label>
                        <input type="text" name="name" id="name" value="{{$location->name}}" class="form-control" readonly></br>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-info" href="{{ url('LocationManagement') }}"> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection