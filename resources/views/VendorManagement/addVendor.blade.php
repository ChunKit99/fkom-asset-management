@extends('VendorManagement.VendorLayout')
@section('content')
<div class="card">
    <div class="card-header">VendorManagement</div>
    <div class="card-body">
        <form action="{{ url('VendorManagement') }}" method="post">
            {!! csrf_field() !!}
            <label>Name</label></br>
            <input type="text" name="name" id="name" class="form-control"></br>
            <label>Contact</label></br>
            <input type="text" name="contact" id="contact" class="form-control"></br>
            <input type="submit" name="Save" class="btn btn-success"></br>
        </form>
    </div>
</div>
@endsection