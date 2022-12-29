@extends('layout')
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
    <!-- @foreach ($assets as $asset)
    {{ $asset->id }}
    @endforeach -->
    <div class="card">
      <h4 class="card-header d-flex justify-content-between align-items-center">
        <div>
          <i class="fal fa-coins"></i> <a href="{{ url('/Asset') }} "class="link-dark text-decoration-none">Asset</a>
        </div>
        <div class="btn-group" role="group" aria-label="button group">
          <a class="btn btn-success" title="New Asset" href="{{ url('/Asset/create') }}">
            <i class="bi bi-plus-circle"></i> Create New Asset</a>
          <a class="btn btn-secondary" title="Download as PDF" href="{{ URL::to('/asset/pdf') }}">
            <i class="bi bi-save"></i> Export to PDF</a>
        </div>
      </h4>
      <div class="card-body">
        <div class="row">
          <div class="col col-md-auto">
            <!-- Search Bar -->
            <form action="/asset/search" method="GET">
              <div class="input-group">
                <div class="form-outline">
                  <input type="search" class="form-control" placeholder="Find serial number here" name="serial_number">
                </div>
                <!-- Search Bar -->
                <!-- Search Bar Button-->
                <button type="submit" class="btn btn-primary" title="Search Asset">
                  <i class="bi bi-search"></i>
                </button>
                <!-- Search Bar Button-->
              </div>
            </form>
          </div>
          <!-- sort -->
          <div class="col col-md-auto">
            <form action="/Asset/sort" method="POST">
              <div class="input-group">
                @csrf
                <!-- <label for="sort_category" class="form-control">Sort by:</label> -->
                <select name="sort_category" id="sort_category" class="form-control">
                  <option value="location_id">Location</option>
                  <option value="category">Category</option>
                  <option value="budget">Budget</option>
                  <option value="vendor_id">Vendor</option>
                  <option value="user_id">Responsible</option>
                </select>
                <button type="submit" class="btn btn-primary" title="Sort Asset">
                  <i class="bi bi-sort-down-alt"></i> Sort by
                </button>
              </div>
            </form>
          </div>
          <!-- filter -->
          <div class="col col-md-auto">
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
              <i class="bi bi-filter"></i> Filter by
            </a>
          </div>
          <!-- New Asset -->
          <!-- <div class="col col-md-auto">
            <a class="btn btn-success" title="New Asset" href="{{ url('/Asset/create') }}">
              <i class="bi bi-plus-circle"></i> Create New Asset</a>
        </div> -->
          <!-- PDF -->
          <!-- <div class="col col-md-auto">
            <a class="btn btn-secondary" title="Download as PDF" href="{{ URL::to('/asset/pdf') }}">
              <i class="bi bi-save"></i> Export to PDF</a>
          </div> -->
        </div>
      </div>
      <div class="collapse" id="collapseFilter">
        <div class="card card-body">
          <form action="/Asset/filter" method="POST">
            @csrf
            <!-- filter category -->
            <div class="mb-3 row">
              <label for="filter_category" class="col-sm-2 col-form-label">Filter by</label>
              <div class="col-sm-10">
                <select name="filter_category" id="filter_category" class="form-control">
                  <option value="apply_all">Apply all</option>
                  <option value="location">Location</option>
                  <option value="category">Category</option>
                  <option value="vendor">Vendor</option>
                  <option value="user">User</option>
                </select>
                <span id="filterCategoryHelpInline" class="form-text">
                  Apply all will filter and match all the condition. Other option will only apply the selected filter category value.
                </span>
              </div>
            </div>
            <!-- location id -->
            <div class="mb-3 row">
              <label for="location_id" class="col-sm-2 col-form-label">Location</label>
              <div class="col-sm-10">
                <select name="location_id" id="location_id" class="form-control">
                  @foreach ($locations as $location)
                  <option value="{{ $location->id }}">{{ $location->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- category -->
            <div class="mb-3 row">
              <label for="category" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10">
                <select name="category" id="category" class="form-control">
                  <option value="computer">Computer</option>
                  <option value="equipment">Equipment</option>
                  <option value="laboratory">Laboratory</option>
                  <option value="printers">Printers</option>
                  <option value="networking_equipment">Networking Equipment</option>
                  <option value="furniture">Furniture</option>
                  <option value="tools">Tools</option>
                </select>
              </div>
            </div>
            <!-- vendor id -->
            <div class="mb-3 row">
              <label for="vendor_id" class="col-sm-2 col-form-label">Vendor</label>
              <div class="col-sm-10">
                <select name="vendor_id" id="vendor_id" class="form-control">
                  @foreach ($vendors as $vendor)
                  <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- user id -->
            <div class="mb-3 row">
              <label for="user_id" class="col-sm-2 col-form-label">User</label>
              <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- button -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </form>
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
                  <!--Serial Number-->
                  <td>{{ $asset->serial_number }}</td>
                  <!--Location Name-->
                  <td>{{ $asset->location_name }}</td>
                  <td>
                    <!--Category-->
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
                  <!--Budget-->
                  <td>{{ $asset->budget }}</td>
                  <!--Vendor-->
                  <td>{{ $asset->vendor_name }}</td>
                  <!--User-->
                  <td>{{ $asset->user_name }}</td>
                  <td>
                    <!-- View Edit Delete Button -->
                    <div class="d-flex justify-content-center">
                      <div class="btn-group" role="group" aria-label="button group">
                        <a href="{{ url('/Asset/' . $asset->id) }}" title="View Asset" class="btn btn-primary">View</a>
                        <a href="{{ url('/Asset/' . $asset->id . '/edit') }}" title="Edit Asset" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" title="Delete Asset" data-bs-target="#confirmDelete{{$loop->iteration}}">
                          Delete
                        </button>
                      </div>
                      <!-- View Edit Delete Button -->
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