<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            <!-- <img src="{{ public_path('assets/images/logo.png') }}" width="100%"  alt=""> -->
        </div>
        <div style="width: 50%; float: left;">
            <h1>All Asset Details</h1>
        </div>
    </div>

    <table style="position: relative; top: 50px;">
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
                </tr>
                @endforeach
              </tbody>
              <!--Table body-->
            </table>
            <!--Table-->

</body>

</html>