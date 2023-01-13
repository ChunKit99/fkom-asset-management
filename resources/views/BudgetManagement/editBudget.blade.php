@extends('layouts.master')
@section('title')
BudgetManagement
@endsection
@section('content')
<div class="row">
    <div class="col-md-11 mx-auto">
        <div class = "card">
        <h4 class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fs-4 bi bi-pen"></i> Edit Budget
            </div>
        </h4>
            <div class = "card-body">
                <form action = "{{ url('Budget/' . $asset->id) }}" method = "post">
                {!! csrf_field() !!}
                @method("PATCH")
                <input type = "hidden" name = "id" id = "id" value = "{{$asset->id}}"/>
                <strong>Serial Number: </strong></br>
                <input type = "text" name = "serial_number" id = "serial_number" value = "{{$asset->serial_number}}" class = "form-control" readonly></br>
                <strong>Category: </strong></br>
                <input type = "text" name = "category" id = "category" value = "{{$asset->category}}" class = "form-control" readonly></br>
                <strong>Budget: </strong></br>
                <input type = "text" name = "budget" id = "budget" value = "{{$asset->budget}}" class = "form-control"></br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-info" href="{{ url('Budget') }}"> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection