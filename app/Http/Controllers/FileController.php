<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\SharedFile;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Validate file size up to 10MB
        ]);

        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->storeAs('files', $request->file('file')->getClientOriginalName());

            return back()->with('success', 'File uploaded successfully.');
        }

        return back()->withErrors(['file' => 'File upload failed.']);
    }

    public function shareFiles(Request $request)
    {
        $request->validate([
            'shared_files' => 'required|array',
            'shared_files.*' => 'string',
            'users' => 'required|array',
            'users.*' => 'numeric|exists:users,id',
        ]);

        $userEmails = User::whereIn('id', $request->users)->pluck('email')->toArray();
        $subject = "Shared Files";
        $body = "Please find attached the files shared with you.";

        $mailtoLinks = array_map(function($email) use ($subject, $body) {
            return "mailto:$email?subject=" . urlencode($subject) . "&body=" . urlencode($body);
        }, $userEmails);

        return back()->with('success', 'Files shared successfully.')->with('mailtoLinks', $mailtoLinks);
    }

}
