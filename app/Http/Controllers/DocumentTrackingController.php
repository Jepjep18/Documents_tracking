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
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $file->move(public_path('upload'), $fileName);

    // Get the latest acceptance record for the current user
    $latestAcceptance = DocumentAcceptance::where('user_id', Auth::id())->latest()->first();

    if ($latestAcceptance) {
        // If there's an existing acceptance record, update the reuploaded file name
        $latestAcceptance->update(['reuploaded_file_name' => $fileName]);
    } else {
        // If no acceptance record exists, create a new one
        $acceptance = new DocumentAcceptance();
        $acceptance->user_id = Auth::id();
        $acceptance->accepted_at = now();
        $acceptance->reuploaded_file_name = $fileName;
        $acceptance->save();
    }

    return redirect()->back()->with('success', 'File uploaded successfully.');
}






}