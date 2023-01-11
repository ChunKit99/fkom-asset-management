@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card">
                <h6 class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fal fa-coins"></i> <a href="{{ url('/LocationManagement') }} " class="link-dark text-decoration-none">
                            <h4>Location</h4>
                        </a>
                    </div>
                    <div class="btn-group" role="group" aria-label="button group">
                        <a title="New Location" href="{{ url('/LocationManagement/create') }}">
                            <button>New Location<span></span></button></a>
                        <!-- <a class="btn btn-secondary" title="Download as CSV" href="{{ URL::to('/asset/csv') }}"> -->
                        <a class="btn btn-secondary" title="Download as CSV" href="{{ route('location.exportcsv') }}">
                            <i class="bi bi-filetype-csv"></i> Download CSV</a>
                    

                    </div>
                </h6>
                <div class="card-body">
                    <br />
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped text-cente">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($location as $item)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>
                                        <a href="{{ url('/LocationManagement/' .$item->id) }}" title="View Location"> <button class="btn btn-primary btn-sm"> <i class="bi bi-eye"></i>View</button></a>

                                        <a href="{{ url('/LocationManagement/' .$item->id . '/edit') }}" title="Edit Location"> <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>Edit</button></a>
                                        <form method="POST" action="{{ url('/LocationManagement/' .$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Location" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="bi bi-trash"></i>Delete</button>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    button {
        border: none;
        display: block;
        position: relative;
        padding: 0.7em 2.4em;
        font-size: 18px;
        background: transparent;
        cursor: pointer;
        user-select: none;
        overflow: hidden;
        color: royalblue;
        z-index: 1;
        font-family: inherit;
        font-weight: 500;
    }

    button span {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        z-index: -1;
        border: 4px solid royalblue;
    }

    button span::before {
        content: "";
        display: block;
        position: absolute;
        width: 8%;
        height: 500%;
        background: var(--lightgray);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-60deg);
        transition: all 0.3s;
    }

    button:hover span::before {
        transform: translate(-50%, -50%) rotate(-90deg);
        width: 100%;
        background: royalblue;
    }

    button:hover {
        color: white;
    }

    button:active span::before {
        background: #2751cd;
    }
</style>
