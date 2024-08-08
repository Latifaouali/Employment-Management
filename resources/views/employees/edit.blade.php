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
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('dashboardLayout') 
    @section('content')
        <div class="row">
            <div class="mt-10">
                <a class="btn btn-primary float-end" href="{{ route('employees.index') }}"> Back</a>
            </div>
            <form class="form" action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h5 class="mt-10">Edit {{ $employee->firstName }} {{ $employee->lastName }} </h5>
                <div class="row" style="margin-top:4%">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>First Name:</strong>
                            <input type="text" name="firstName" value=" {{ $employee->firstName }}" class="form-control"
                                placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <strong>Last Name :</strong>
                            <input type="text" name="lastName" value=" {{ $employee->lastName }}" class="form-control"
                                placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <strong>Email :</strong>
                            <input type="email" name="email" value=" {{ $employee->email }}" class="form-control"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <strong>Department:</strong>
                            <select name="department_id" class="form-select" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
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
