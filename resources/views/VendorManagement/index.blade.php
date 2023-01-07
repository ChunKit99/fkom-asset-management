@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Vendor</div>
                        <div class="card-body">
                            
                            <a href="{{ url('/VendorManagement/create') }}">
                                    <button> New Vendor
                                      <span></span>
                                    </button>
                            </a>
                            

                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vendor Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $item)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $item->name}}</td>
                                            <td>{{ $item->contact}}</td>
                                            <td>{{ $item->email}}</td>
                                            <td>
                                                <a href="{{ url('/VendorManagement/' .$item->id) }}" title="View Vendor"> <button class="btn btn-info btn-sm"> <i class="bi bi-eye"></i>View</button></a>

                                                <a href="{{ url('/VendorManagement/' .$item->id . '/edit') }}" title="Edit Vendor"> <button class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>Edit</button></a> 
                                                  {{ csrf_field() }}
                                                  {{ method_field('DELETE') }}
                                                  <button type="submit" class="btn btn-danger btn-sm" title="Delete Vendor" onclick="return confirm(&quot;Confirm delete?&quot;)">
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