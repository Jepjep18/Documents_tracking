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
        
        $document = Document::where('file_name', $file)->first();
        if ($document) {
            $userId = Auth::id();

            $document->acceptance()->updateOrCreate(
                ['file_name' => $file],
                [
                    'accepted_at' => now(),
                    'user_id' => $userId, 
                ]
            );
        }

        return response()->download($filePath);
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', 
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $fileName);

            $userId = Auth::id();

            // Check if there's an existing acceptance record for the user
            $documentAcceptance = DocumentAcceptance::where('user_id', $userId)->latest()->first();

            if ($documentAcceptance) {
                // If an acceptance record exists, update the reuploaded file name
                $documentAcceptance->update([
                    'reuploaded_file_name' => $fileName,
                ]);
            } else {
                // If no acceptance record exists, create a new one
                $newAcceptance = new DocumentAcceptance();
                $newAcceptance->user_id = $userId;
                $newAcceptance->reuploaded_file_name = $fileName;
                $newAcceptance->accepted_at = now();
                $newAcceptance->save();
            }
        }

        return back()->with('success', 'File uploaded successfully.'); // Redirect back to the page
    }



}
