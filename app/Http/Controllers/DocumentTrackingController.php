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
    
    // Update the acceptance date when the file is downloaded
    $document = Document::where('file_name', $file)->first();
    if ($document) {
        // Get the authenticated user ID
        $userId = Auth::id();

        // Associate the acceptance record with the user ID
        $document->acceptance()->updateOrCreate(
            ['file_name' => $file],
            [
                'accepted_at' => now(),
                'user_id' => $userId, // Associate the acceptance with the user
            ]
        );
    }

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

        // Find the document acceptance record by original file name
        $documentAcceptance = DocumentAcceptance::where('file_name', $fileName)->first();

        if ($documentAcceptance) {
            // Update the reuploaded file name
            $documentAcceptance->update([
                'reuploaded_file_name' => $fileName,
            ]);
        }
    }

    return back(); // Redirect back to the page
}


}
