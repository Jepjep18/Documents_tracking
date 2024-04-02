<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('doctrack.index', compact('documents'));
    }

    public function store(Request $request)
{
    $request->validate([
        'personnel' => 'required',
        'document' => 'required|file|max:10240', // Example: max 10MB file size
    ]);

    // Store the file in 'public/upload' directory
    $documentPath = $request->file('document')->store('upload', 'public');

    Document::create([
        'personnel' => $request->input('personnel'),
        'document_path' => $documentPath,
    ]);

    return redirect()->route('doctrack.index')->with('success', 'Document created successfully!');
}

    
}
