<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;


class EmployeeController extends Controller
{
    /**
     * Get all employees
     */
    public function index(Request $request): View
    {
        try {
            if ($request) {
                $employees = Employee::query()
                    ->when(
                        $request->q,
                        function (Builder $builder) use ($request) {
                            $builder->where('firstName', 'like', "%{$request->q}%")
                                ->orWhere('lastName', 'like', "%{$request->q}%");
                        }
                    )
                    ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                    ->select('employees.*', 'departments.name as departments_name')
                    ->simplePaginate(5);
            } else {
                $employees = Employee::latest()
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->select('employees.*', 'departments.name as departments_name')
                    ->simplePaginate(5);
            }
            return view('employees.index', compact('employees'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage());
            return view('employees.index');
        }
    }

    /**
     * Show create new employee form
     */

    public function create(): View
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     *create new employee 
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'exists' => 'The selected :attribute is invalid.',
            'unique' => 'The :attribute has already been taken.'
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            Employee::create($request->all());

            return redirect()->route('employees.index')
                ->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return Redirect::back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Edite employee form
     */
    public function edit(Employee $employee): View
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * update employee 
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'exists' => 'The selected :attribute is invalid.',
            'unique' => 'The :attribute has already been taken.'
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $employee->update($request->all());
            return redirect()->route('employees.index')
                ->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return Redirect::back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * delete employee 
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        try {
            $employee->delete();
            return redirect()->route('employees.index')
                ->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error : ' . $e->getMessage());
            return Redirect::back()
                ->with('error', $e->getMessage());
        }
    }
}
