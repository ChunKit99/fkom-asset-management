@extends('layouts.masteruser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>
    
    

</div>

@endsection