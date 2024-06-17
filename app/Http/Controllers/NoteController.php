<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use PDF;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('secretary.notes', compact('notes'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_notes' => 'required|string',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->meeting_notes;
        $note->save();

        return redirect()->route('dashboard')->with('success', 'Note saved successfully.');
    }

    public function download($id)
    {
        $note = Note::findOrFail($id);
        $pdf = PDF::loadView('notes.pdf', compact('note'));
        return $pdf->download('note-' . $note->id . '.pdf');
    }
}
