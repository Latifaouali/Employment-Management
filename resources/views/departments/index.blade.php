<!DOCTYPE html>
<html>

<head>
    <style>
    </style>
    <title>Departments</title>
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
        @if ($error = Session::get('error'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row departments">
            <div class="col-lg-12 margin-tb mt-20 ">
                <div class="pull-right mt-10 float-end">
                    <a class="btn btn-success" href="{{ route('departments.create') }}"> Create New Department</a>
                </div>
                <div style="margin-top : 2% !important">
                    <table class="table table-bordered">
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->location }}</td>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('departments.edit', $department->id) }}">Edit</a>
                                        <a class="btn btn-primary"
                                            href="{{ route('departments.show', $department->id) }}">Show</a>
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
        {!! $departments->links() !!}
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
