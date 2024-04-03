<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        // Retrieve documents belonging to the currently authenticated user
        $documents = Document::where('user_id', Auth::id())->get();
        
        return view('doctrack.index', compact('documents'));
    }

    public function store(Request $request)
{
    $request->validate([
        'department' => 'required', // Validate the department field
        'personnel' => 'required',
        'document' => 'required|file|max:10240', // Example: max 10MB file size
    ]);

    // Store the file in 'public/upload' directory
    $documentPath = $request->file('document')->store('upload', 'public');

    // Create a new Document instance
    $document = new Document();
    $document->department = $request->input('department');
    $document->personnel = $request->input('personnel');
    $document->document_path = $documentPath;

    // Associate the document with the currently authenticated user
    Auth::user()->documents()->save($document);

    return redirect()->route('doctrack.index')->with('success', 'Document created successfully!');
}

public function edit($id)
    {
        // Fetch the document from the database
        $document = Document::findOrFail($id);
        
        // Return a view for editing the document
        return view('documents.edit', compact('document'));
    }

    public function destroy($id)
    {
        // Find the document by ID
        $document = Document::findOrFail($id);
        
        // Delete the document
        $document->delete();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Document deleted successfully.');
    }
    
}
