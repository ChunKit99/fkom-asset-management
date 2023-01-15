@extends('layouts.master')
@section('title', 'Admin Dashboard')
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
    <br>
    <div class="card-group">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <p class="card-text, text-center">
                    <span class="counter display-3 text-white d-block">{{$count_under_review}}</span>
                    <span class="h5 text-gray">Pending Maintenance</span>
                </p>
            </div>
        </div>
        <div class="card text-white bg-danger">
            <div class="card-body">
                <p class="card-text, text-center">
                    <span class="counter display-3 text-white  d-block">{{$count_rejected}}</span>
                    <span class="h5 text-gray">Rejected Application</span>
                </p>
            </div>
        </div>
        <div class="card text-white bg-success">
            <div class="card-body">
                <p class="card-text, text-center">
                    <span class="counter display-3 text-white  d-block">{{$count_approved}}</span>
                    <span class="h5 text-gray">Approved Application</span>
                </p>
            </div>
        </div>
    </div>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="https://www.concerto.co.uk/wp-content/uploads/2019/01/concerto-header-modules.svg"
                    class="img-fluid" alt="image">

            </div>
            <div class="col">
                <h5>Function</h5>

                <div class="row">
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User Account Information</h5>
                                <p class="card-text">Adding new user account.</p>
                                <a class="btn btn-info" 
                                    href="{{ url('/Admin/ManageUserAccount/create') }}">
                                    Click here</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Maintenance Management Report</h5>
                                <p class="card-text">Generate report of maintenance involved.</p>
                                <a class="btn btn-info" 
                                    href="{{ url('#') }}">
                                    Click here</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Budget Management Information</h5>
                                <p class="card-text">Insight of budget according to category asset.</p>
                                <a class="btn btn-info"  href="{{ url('/Budget/show') }}">
                                    Click here</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Asset Management Information </h5>
                                <p class="card-text">Adding new asset.</p>
                                <a class="btn btn-info"  href="{{ URL::to('/Asset/create') }}">
                                    Click here</a>

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Location Management Information</h5>
                                <p class="card-text">Adding new location.</p>
                                <a class="btn btn-info"  href="{{ URL::to('/LocationManagement/create') }}">
                                    Click here</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Vendor Management Information</h5>
                                <p class="card-text">Adding new vendor.</p>
                                <a class="btn btn-info" href="{{ URL::to('/VendorManagement/create') }}">
                                    Click here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection