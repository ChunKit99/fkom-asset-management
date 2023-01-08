@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header text-center"><b>User Information</b></div>
            <div class="card-body">
                <form action="{{ url('admin/'.$user->id) }}" method="post">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id">
                    <label>Username</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" readonly>
                    <label>Email address</label>
                    <br>
                    <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control"
                        readonly>
                    <label>Password</label>
                    <br>
                    <input type="text" name="password" id="password" value="{{$user->password}}" class="form-control" readonly>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col text-center">
                            <a href="{{ url('/admin') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Back</a>
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