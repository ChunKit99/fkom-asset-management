<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <title>Asset Details</title>
</head>

<body>
    <h1>Maintenance Records</h1>

    <div class="table-responsive text-nowrap">
        <!--Table-->
        <table class="table table-striped text-center">
            <!--Table head-->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>Request Time</th>
                    <th>Approve Time</th>
                    <th>Status</th>
                    <th>Cost</th>
                    @if(Auth::check() && Auth::user()->role_as==1)
                    <th>Responsible</th>
                    @endif
                </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
                @foreach ($maintenances as $maintenance)
                <tr>
                    <!--  {{ $asset->vendor_name }} | {{ $asset->user_name }} if using join -->
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $maintenance->serial_number }}</td>
                    <td>{{ $maintenance->request_time }}</td>
                    <td>{{ $maintenance->approve_time }}</td>
                    <td>
                        <!--Category-->
                        @if($maintenance->status == 'under_review')
                        Under Review
                        @elseif($maintenance->status == 'approved')
                        Approved
                        @elseif($maintenance->status == 'rejected')
                        Rejected
                        @elseif($maintenance->status == 'completed')
                        Completed
                        @elseif($maintenance->status == 'cancelled')
                        Cancelled
                        @else
                        @endif
                    </td>
                    <td>{{ $maintenance->cost }}</td>
                    @if(Auth::check() && Auth::user()->role_as==1)
                    <td>{{ $asset->user_name }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <!--Table body-->
        </table>
        <!--Table-->

</body>

</html>