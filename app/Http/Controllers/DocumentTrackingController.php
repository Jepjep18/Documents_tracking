<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentTrackingController extends Controller
{
    public function index()
    {
        return view('personnel.document');
    }
}
