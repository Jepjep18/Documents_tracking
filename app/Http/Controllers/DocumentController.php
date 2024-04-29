<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Department; // Import the Department model
use Spatie\Permission\Models\Role;
use App\Models\User;


class DocumentController extends Controller
{
    public function index()
{
    // Check if the logged-in user has the admin role
    $isAdmin = Auth::user()->hasRole('admin');

    // Fetch documents based on user role
    if ($isAdmin) {
        // If admin, fetch all documents
        $documents = Document::all();
    } else {
        // If not admin, fetch documents associated with the currently logged-in user
        $documents = Document::where('user_id', Auth::id())->get();
    }

    // Load the user with the department information
    $documents->load('user.department');

    // Fetch departments and personnel users
    $departments = Department::all();
    $personnelRole = Role::where('name', 'personnel')->first();
    $personnelUsers = $personnelRole ? $personnelRole->users()->get() : [];

    // Return the view with the fetched data
    return view('doctrack.index', compact('documents', 'departments', 'personnelUsers'));
}



    public function store(Request $request)
{
    $request->validate([
        'department' => 'required',
        'personnel' => 'required',
        'document.*' => 'required|file|max:10240',
    ]);

    $documents = [];

    foreach ($request->file('document') as $file) {
        $originalFilename = $file->getClientOriginalName();

        // Store the file in the 'public/upload' directory with its original name
        $documentPath = $file->storeAs('upload', $originalFilename, 'public');

        $document = new Document();

        $document->department = $request->input('department');
        $document->personnel = $request->input('personnel');
        $document->file_name = $originalFilename;
        $document->user_id = Auth::id();
        $document->save();

        $documents[] = $document;
    }

    return redirect()->route('doctrack.index')->with('message', 'Documents created successfully!');
}



public function edit($id)
{
    $document = Document::findOrFail($id);
    $departments = Department::all(); 
    $personnel = User::role('personnel')->get(); 
    return view('doctrack.edit', compact('document', 'departments', 'personnel'));
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

    public function getPersonnel($departmentId)
{
    $department = Department::find($departmentId);
    $personnel = $department->users()->pluck('name', 'id')->toArray();
    return response()->json($personnel);
}

}
