<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Make sure to import the User model if it's not already imported

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Fetch users, assuming you have a User model
        return view('user.index', compact('users')); // Pass the $users variable to the view
    }
}
