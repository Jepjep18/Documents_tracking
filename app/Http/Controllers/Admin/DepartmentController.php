<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller; // Use the correct base controller

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.index', compact('roles', 'departments'));
    }

    public function create()
    {
        return view('admin.departments.create'); // Use the correct view path
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255'
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success','Department created successfully.');
    }

    /**
     * Remove the specified department from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department')); // Use the correct view path
    }

    /**
     * Update the specified department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($request->only('name'));

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }
}
