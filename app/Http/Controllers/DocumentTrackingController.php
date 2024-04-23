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
        $documents = Document::with('user', 'acceptance')->get();
        return view('personnel.document', ['documents' => $documents]);
    }

    public function download($file)
    {
        $filePath = public_path('upload/' . $file);
        return response()->download($filePath);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Adjust the max file size as needed
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $fileName);

            // Create or update the document record
            $document = new Document();
            $document->department = ''; // Add department data if available
            $document->personnel = Auth::user()->name; // Associate with the logged-in user
            $document->file_name = $fileName;
            $document->save();
        }

        return back(); // Redirect back to the page
    }
}
