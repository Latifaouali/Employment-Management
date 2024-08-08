<!DOCTYPE html>
<html>

<head>
    <title>Reports</title>
    <style>
        #myChart {
            width: 80%;
            margin-left: 5%;
        }
    </style>
</head>

<body>
    @extends('dashboardLayout')
    @section('content')
        <h1 class="text-center">Reports</h1>
        <canvas id="myChart" height="100px"></canvas>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var departmentNames = {!! json_encode($departmentNames) !!};
            var employeeCountByDepartment = {!! json_encode($employeeCountByDepartment) !!};

            var labels = Object.values(departmentNames);
            var data = Object.values(employeeCountByDepartment);

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Number of Employees',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data,
                }]
            };

            const chartConfig = {
                type: 'bar',
                data: chartData,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                chartConfig
            );
        </script>
    @endsection
</body>

</html>
