<!DOCTYPE html>
<html>

<head>
    <style>
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
            <div class="col-lg-12 margin-tb mt-20 ">
                <div style="margin-top : 2% !important">
                    <h1>Employees in department {{$department->name}}</h1>
                    <table class="table table-bordered">
                        <tr>
                            <th>Number</th>
                            <th>firstName</th>
                            <th>lastName</th>
                            <th>email</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $employee->firstName }}</td>
                                <td>{{ $employee->lastName }}</td>
                                <td>{{ $employee->email }}</td>
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
