<!DOCTYPE html>
<html>

<head>
    <style>
        .form {
            width: 60% !important;
            margin-top: 3% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
    </style>
    <title>Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('dashboardLayout') 
    @section('content')
        <div class="row">
            <div class="mt-10">
                <a class="btn btn-primary float-end" href="{{ route('departments.index') }}"> Back</a>
            </div>
            <form class="form" action="{{ route('departments.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h5 class="mt-10">Edit {{ $department->name }}</h5>
                <div class="row" style="margin-top:4%">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" value=" {{ $department->name }}" class="form-control"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <strong>Location:</strong>
                            <input type="text" name="location" value=" {{ $department->location }}" class="form-control"
                                placeholder="Location">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center " style="margin-top:4%">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
        </div>
    @endsection
</body>

</html>
