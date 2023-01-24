@extends($layout)
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
                    @if(Auth::check() && Auth::user()->role_as==1)
                    <div class="btn-group" role="group" aria-label="button group">
                        <a class="btn btn-success" title="New Location" href="{{ url('/LocationManagement/create') }}">
                            <i class="bi bi-plus-circle-dotted"></i> New Location</a>
                        <a class="btn btn-secondary" title="Download as CSV" href="{{ route('location.exportcsv') }}">
                            <i class="bi bi-file-earmark-arrow-down"></i> Download CSV</a>
                    </div>
                    @endif
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
                                        @if(Auth::check() && Auth::user()->role_as==1)
                                        <a href="{{ url('/LocationManagement/' .$item->id . '/edit') }}" title="Edit Location"> <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>Edit</button></a>
                                        <form method="POST" action="{{ url('/LocationManagement/' .$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Location" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="bi bi-trash"></i>Delete</button>
                                        </form>
                                        @endif
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
</style>