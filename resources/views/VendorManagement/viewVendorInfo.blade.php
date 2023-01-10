@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">Vendor Information</div>
    <div class="card-body">
        <form action="{{ url('Vendor/'.$vendors->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            
            <label>#</label>
            <input type="text" name="id" id="id" value="{{$vendors->id}}" id="id" class="form-control" readonly> <br>
            <label>Name</label>
            <input type="text" name="name" id="name" value="{{$vendors->name}}" class="form-control" readonly></br>
            <label>Contact</label></br>
            <input type="text" name="contact" id="contact" value="{{$vendors->contact}}" class="form-control" readonly></br>
            <label>Email</label></br>
            <input type="text" name="email" id="email" value="{{$vendors->email}}" class="form-control" readonly></br>
            <a class="btn btn-info" href="{{ url('VendorManagement') }}"> Back</a></br>

        </form>
    </div>
</div>


@endsection