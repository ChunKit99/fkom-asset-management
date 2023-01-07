@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>User Information</b></div>
            <div class="card-body">
                <form action="{{ url('admin/'.$admins->id) }}" method="post">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <input type="hidden" name="id" id="id" value="{{$admins->id}}" id="id">
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$admins->name}}" class="form-control" readonly>
                    <label>Email address</label>
                    <br>
                    <input type="text" name="email" id="email" value="{{$admins->email}}" class="form-control"
                        readonly>
                    <label>Password</label>
                    <br>
                    <input type="text" name="password" id="password" value="{{$admins->password}}" class="form-control" readonly>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                                <input type="submit" value="Back" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection