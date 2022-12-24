@extends('VendorManagement.VendorLayout')
@section('content')
<div class="card">
    <div class="card-header">Vendor Information Edit</div>
    <div class="card-body">
        <form action="{{ url('Vendor/'.$vendors->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            
            <input type="hidden" name="id" id="id" value="{{$vendors->id}}" id="id">
            <label>Title</label>
            <input type="text" name="name" id="name" value="{{$vendors->name}}" class="form-control"></br>
            <label>Author</label></br>
            <input type="text" name="contact" id="contact" value="{{$vendors->contact}}" class="form-control"></br>
            <input type="submit" value="Update" class="btn btn-success"></br>
        </form>
    </div>
</div>


@endsection