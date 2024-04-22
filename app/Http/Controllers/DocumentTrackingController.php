<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentAcceptance;
use Illuminate\Support\Facades\Auth;

class DocumentTrackingController extends Controller
{
    public function index()
    {
        $documents = Document::with('acceptance')->get();
        return view('personnel.document', ['documents' => $documents]);
    }

    public function download($file)
    {
        $filePath = public_path('upload/' . $file);
        $document = Document::where('file_name', $file)->first();
        if ($document) {
            $acceptance = $document->acceptance ?? new DocumentAcceptance();
            $acceptance->document_id = $document->id;
            $acceptance->user_id = Auth::id();
            $acceptance->accepted_at = now();
            $acceptance->file_name = $file;
            $acceptance->save();
        }
        return response()->download($filePath);
    }

    public function upload(Request $request)
{
    // Validate the request
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:2048', // Add appropriate validation rules
    ]);

    // Get the file
    $file = $request->file('file');

    // Get the original file name
    $fileName = $file->getClientOriginalName();

    // Move the uploaded file to the desired location
    $file->move(public_path('upload'), $fileName);

    // Create a new acceptance record
    $acceptance = new DocumentAcceptance();
    $acceptance->user_id = Auth::id();
    $acceptance->accepted_at = now();
    $acceptance->reuploaded_file_name = $fileName; // Store the reuploaded file name
    $acceptance->save();

    // Redirect back or return a response
    return redirect()->back()->with('success', 'File uploaded successfully.');
}

    


}
