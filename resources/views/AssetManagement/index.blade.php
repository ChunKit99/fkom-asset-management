@extends('AssetManagement.layout')
@section('title')
Asset Management
@endsection
@section('content')
<div class="row">
  <div class="col-md-11 mx-auto">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p>{{ $message }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($message = Session::get('warning'))
    <div class="alert alert-warning  alert-dismissible fade show" role="alert">
      <p>{{ $message }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card">
      <h4 class="card-header d-flex justify-content-between align-items-center">
        <div>
          <i class="fal fa-coins"></i> Asset
        </div>
        <a class="btn btn-sm btn btn-success " href="{{ url('/Asset/create') }}"><i class="bi bi-plus-circle"></i> Create New Asset</a>
      </h4>
      <div class="card-body">
        <div class="row">
          <div class="col">
          <form action="/asset/search" method="GET">
            <div class="input-group">
              <div class="form-outline">
              <input type="search" class="form-control" placeholder="Find serial number here" name="serial_number">
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          </div>
          <div class="col col-lg-2">
            <a class="btn btn-secondary float-end" href="{{ URL::to('/asset/pdf') }}">Export to PDF</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <section>
          <div class="table-responsive text-nowrap">
            <!--Table-->
            <table class="table table-striped text-center">
              <!--Table head-->
              <thead>
                <tr>
                  <th>#</th>
                  <th>Serial Number</th>
                  <th>Location</th>
                  <th>Category</th>
                  <th>Budget</th>
                  <th>Vendor</th>
                  <th>Responsible</th>
                  <th>Actions</th>
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
                  <td>
                    @if($asset->category == 'computer')
                    Computer
                    @elseif($asset->category == 'equipment')
                    Equipment
                    @elseif($asset->category == 'laboratory')
                    Laboratory
                    @elseif($asset->category == 'printers')
                    Printers
                    @elseif($asset->category == 'networking_equipment')
                    Networking Equipment
                    @elseif($asset->category == 'furniture')
                    Furniture
                    @elseif($asset->category == 'tools')
                    Tools
                    @else
                    @endif
                  </td>
                  <td>{{ $asset->budget }}</td>
                  <td>{{ $asset->vendor_name }}</td>
                  <td>{{ $asset->user_name }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/Asset/' . $asset->id) }}" title="View Asset" class="btn btn-primary">View</a>
                        <a href="{{ url('/Asset/' . $asset->id . '/edit') }}" title="Edit Asset" class="btn btn-warning">Edit</a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" title="Delete Asset" data-bs-target="#confirmDelete{{$loop->iteration}}">
                      Delete
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="confirmDelete{{$loop->iteration}}" tabindex="-1" aria-labelledby="confirmDelete{{$loop->iteration}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Asset</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to delete?</p>
                              <strong>Serial Number: </strong>{{$asset->serial_number}}
                            </div>
                            <div class="modal-footer">
                            <form action="{{ url('/Asset' . '/' . $asset->id)}}" method="POST" style="width:fit-content">
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Asset">Delete</button>
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end Modal  -->
                    </div>
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