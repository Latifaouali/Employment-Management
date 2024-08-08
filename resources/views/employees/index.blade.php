<!DOCTYPE html>
<html>

<head>
    <style>
        .search {          
            margin-bottom: 2%;
            display: flex;
            justify-content: flex-end;
            justify-content: center;
        }

        .search-items {
            width: 50%;
            margin-top: 6%;
        }
    </style>
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('dashboardLayout') 
    @section('content')
        @if ($message = Session::get('success'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <form action="{{ route('employees.index') }}" method="get" class="search">
                <div class="row search-items">
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3" placeholder="search" name="q">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-primary form-control mb-3" value="Search">
                    </div>
                </div>
            </form>
            <div class="col-lg-12 margin-tb mt-20 ">
                <div class="pull-right mt-10 float-end">
                    <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
                </div>
                <div style="margin-top : 2% !important">
                    <table class="table table-bordered">
                        <tr>
                            <th>Number</th>
                            <th>firstName</th>
                            <th>lastName</th>
                            <th>email</th>
                            <th>Department</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $employee->firstName }}</td>
                                <td>{{ $employee->lastName }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->departments_name }}</td>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        {!! $employees->links() !!}
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
