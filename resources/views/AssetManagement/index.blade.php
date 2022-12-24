@extends('AssetManagement.layout')
@section('content')
<div class="row">
  <div class="col-md-9 mx-auto">
    <div class="card">
      <h4 class="card-header d-flex justify-content-between align-items-center">
        <div>
          <i class="fal fa-coins"></i> Asset
        </div>
        <a class="btn btn-sm btn btn-success " href="{{ url('/Asset/create') }}"> Create New Asset</a>
      </h4>

      <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
        @endif
        <section>
          <div class="table-responsive text-nowrap">
            <!--Table-->
            <table class="table table-striped">
              <!--Table head-->
              <thead>
                <tr>
                  <th>#</th>
                  <th>Serial Number</th>
                  <th>Location</th>
                  <th>Category</th>
                  <th>Budget</th>
                  <th>Vendor</th>
                  <th>Responsible Faculty Members</th>
                </tr>
              </thead>
              <!--Table head-->

              <!--Table body-->
              <tbody>
                @foreach ($assets as $asset)
                <tr>
                  <!--  {{ $asset->vendor_name }} | {{ $asset->user_name }} if using join -->
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $asset->serial_number }}</td>
                  <td>{{ $asset->location }}</td>
                  <td>{{ $asset->category }}</td>
                  <td>{{ $asset->budget }}</td>
                  <td>{{ $asset->vendor->name }}</td>
                  <td>{{ $asset->user->name }}</td>
                  <td>
                    <form action="{{ url('/Asset' . '/' . $asset->id)}}" method="POST" style="width:fit-content">
                      <a href="{{ url('/Asset/' . $asset->id) }}" title="View Asset" class="btn btn-info btn-sm">View</a>
                      <a href="{{ url('/Asset/' . $asset->id . '/edit') }}" title="Edit Asset" class="btn btn-primary btn-sm">Edit</a>
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-danger btn-sm" title="Delete Asset" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <!--Table body-->
            </table>
            <!--Table-->
          </div>
        </section>

      </div>
    </div>
  </div>
</div>
@endsection