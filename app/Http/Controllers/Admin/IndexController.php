<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        $departments = Department::all();
        return view('admin.index', compact('roles', 'departments'));
    }

}
