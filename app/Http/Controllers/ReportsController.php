<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class ReportsController extends Controller
{
    public function index(): View
    {
        $employeeCountByDepartment = Employee::select('department_id', DB::raw('COUNT(*) as count'))
        ->groupBy('department_id')
        ->get()
        ->keyBy('department_id')
        ->map(function ($item) {
            return $item->count;
        });

    // Calculate the total number of employees
    $totalEmployees = $employeeCountByDepartment->sum();

    // Calculate the percentage of employees in each department
    $percentagesByDepartment = $employeeCountByDepartment->map(function ($count) use ($totalEmployees) {
        return round(($count / $totalEmployees) * 100, 2);
    });

    // Retrieve department names
    $departmentNames = DB::table('departments')->pluck('name', 'id');

    return view('reports', [
        'employeeCountByDepartment' => $employeeCountByDepartment,
        'percentagesByDepartment' => $percentagesByDepartment,
        'departmentNames' => $departmentNames,
    ]);
    }
}
