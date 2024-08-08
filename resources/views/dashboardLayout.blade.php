<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <title>Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a class="navbar-brand">
                <span style="color: #293462">Employee </span><strong style="color: #d61c4e"> Management</strong>
            </a>
            <a class="tt-toggle-sidebar">
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            Latifa ouali
                        </span> </a>
                    <!-- End Profile Nav -->
            </ul>
        </nav>
    </header>
    <aside class="sidebar" v-if="!isOpen" id="my-div">
        <ul class="sidebar-nav flex-column" id="sidebar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reports') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link">Logout</a>
                </li>
            @endguest
        </ul>
    </aside>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
