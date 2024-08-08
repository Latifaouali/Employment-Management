<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
  /**
   * Get all departments
   */
  public function index(Request $request): View
  {
    try {
      $departments = Department::latest()->simplePaginate(5);
      return view('departments.index', compact('departments'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    } catch (\Exception $e) {
      Log::error('Error : ' . $e->getMessage());
      return Redirect::back()
        ->with('error', $e->getMessage());
    }
  }

  /**
   * Show create new department form
   */

  public function create(): View
  {
    return view('departments.create');
  }

  /**
   *create new department 
   */
  public function store(Request $request): RedirectResponse
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'location' => 'required',
    ], [
      'required' => 'The :attribute field is required.',
    ]);
    if ($validator->fails()) {
      return Redirect::back()
        ->withErrors($validator)
        ->withInput();
    }
    try {
      Department::create($request->all());
      return redirect()->route('departments.index')
        ->with('success', 'Department created successfully.');
    } catch (\Exception $e) {
      Log::error('Error creating department: ' . $e->getMessage());
      return Redirect::back()
        ->with('error', $e->getMessage());
    }
  }

  /**
   * Edit department form
   */
  public function edit(Department $department): View
  {
    return view('departments.edit', compact('department'));
  }

  /**
   * update department 
   */
  public function update(Request $request, Department $department): RedirectResponse
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'location' => 'required',
    ], [
      'required' => 'The :attribute field is required.',
    ]);
    if ($validator->fails()) {
      return Redirect::back()
        ->withErrors($validator)
        ->withInput();
    }

    try {
      $department->update($request->all());
      return redirect()->route('departments.index')
        ->with('success', 'Department updated successfully.');
    } catch (\Exception $e) {
      Log::error('Error updating Department: ' . $e->getMessage());
      return Redirect::back()
        ->with('error', $e->getMessage());
    }
  }

  /**
   * Delete a department
   */

  public function destroy(Department $department): RedirectResponse
  {
    try {
      if ($department->employees()->exists()) {
        return redirect()->route('departments.index')
          ->with('error', 'Cannot delete department. There are employees assigned to it.');
      } else {
        $department->delete();
        return redirect()->route('departments.index')
          ->with('success', 'Department deleted successfully');
      }
    } catch (\Exception $e) {
      Log::error('Error: ' . $e->getMessage());
      return Redirect::back()
        ->with('error', $e->getMessage());
    }
  }

  /**
   * show  employees in each department
   */

  public function show(Department $department): View
  {
    try {
      $employees = Employee::latest()
        ->where('department_id', $department->id)
        ->simplePaginate(5);

      return view('departments.show', compact('department', 'employees'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    } catch (\Exception $e) {
      Log::error('Error: ' . $e->getMessage());
      return Redirect::back()
        ->with('error', $e->getMessage());
    }
  }
}
