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
    // Fetch document data and pass it to the edit view
    $document = Document::findOrFail($id);
    return view('doctrack.edit', compact('document'));
}


public function destroy($id)
{
    // Delete the document
    $document = Document::findOrFail($id);
    $document->delete();
    
    // Redirect back to index page with success message
    return redirect()->route('doctrack.index')->with('success', 'Document deleted successfully');
}
    
}
