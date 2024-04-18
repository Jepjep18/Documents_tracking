<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Department; // Import the Department model
use Spatie\Permission\Models\Role;


class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        $departments = Department::all(); // Fetch all departments
        $personnelRole = Role::where('name', 'personnel')->first();
        $personnelUsers = $personnelRole ? $personnelRole->users()->get() : [];
        
        return view('doctrack.index', compact('documents', 'departments', 'personnelUsers'));
    }

    public function store(Request $request)
{
    $request->validate([
        'department' => 'required', 
        'personnel' => 'required',
        'document' => 'required|file|max:10240', 
    ]);

    $originalFilename = $request->file('document')->getClientOriginalName();

    // Store the file in the 'public/upload' directory with its original name
    $documentPath = $request->file('document')->storeAs('upload', $originalFilename, 'public');

    $document = new Document();
    $document->department = $request->input('department');
    $document->personnel = $request->input('personnel');
    $document->file_name = $originalFilename; 
    $document->user_id = Auth::id(); 
    $document->save();

    return redirect()->route('doctrack.index')->with('success', 'Document created successfully!');
}


    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('doctrack.edit', compact('document'));
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        
        return redirect()->route('doctrack.index')->with('success', 'Document deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department' => 'required',
            'personnel' => 'required',
            'document' => 'file|max:10240', 
        ]);

        $document = Document::findOrFail($id);

        $document->department = $request->input('department');
        $document->personnel = $request->input('personnel');

        if ($request->hasFile('document')) {
            $originalFilename = $request->file('document')->getClientOriginalName();

            $newDocumentPath = $request->file('document')->store('upload', 'public');
            $document->file_name = $originalFilename;
            $document->document_path = $newDocumentPath;
        }

        $document->save();

        return redirect()->route('doctrack.index')->with('success', 'Document updated successfully');
    }
}
