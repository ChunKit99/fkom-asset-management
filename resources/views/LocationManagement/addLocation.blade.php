@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">LocationManagement</div>
    <div class="card-body">
        <form action="{{ url('LocationManagement') }}" method="post">
            {!! csrf_field() !!}
            <label>Location</label></br>
            <input type="text" name="name" id="name" class="form-control"></br>
            <input type="submit" name="Save" class="btn btn-success"></br>
        </form>
    </div>
</div>
@endsection