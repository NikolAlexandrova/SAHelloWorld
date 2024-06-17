<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Budget;
use App\Models\Message;
use App\Models\Note;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function chairmanDashboard()
    {
        $users = User::all();
        $files = Storage::files('files');
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $notifications = auth()->user()->unreadNotifications->unique('id');

        return view('dashboard.chairman', compact('users', 'files', 'budget', 'notes', 'notifications'));
    }

    public function activitiesCommitteeMemberDashboard()
    {
        // Retrieve the latest budget from the database
        $budget = Budget::latest()->first();
        // Retrieve all notes
        $notes = Note::all();
        $notifications = Notification::all();

        return view('dashboard.activitiesCommitteeMember', compact('budget', 'notes', 'notifications'));
    }

    public function boardMemberDashboard()
    {
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $notifications = Notification::all();

        return view('dashboard.boardMember', compact('budget', 'notes', 'notifications'));
    }

    public function headOfActivitiesDashboard()
    {
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $activities = Activity::all();
        $notifications = Notification::all();

        return view('dashboard.headOfActivities', compact('budget', 'activities', 'notes', 'notifications'));
    }

    public function headOfMediaDashboard(ArticleController $articleController)
    {
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $notifications = Notification::all();
        $articles = Article::all();
      
        return view('dashboard.headOfMedia', compact('budget', 'notes', 'notifications', 'articles'));

    }

    public function mediaTeamMemberDashboard()
    {
        // Retrieve the latest budget from the database
        $budget = Budget::latest()->first();
        // Retrieve all notes
        $notes = Note::all();
        $notifications = Notification::all();
        $articles = Article::all();
      
        return view('dashboard.mediaTeamMember', compact('budget', 'notes', 'notifications', 'articles'));
    }

    public function secretaryDashboard()
    {
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $messages = Message::all();
        $unreadCount = Message::where('is_read', false)->count();
        $files = Storage::files('files');
        $users = User::all();
        $notifications = Notification::all();

        return view('dashboard.secretary', compact('budget', 'notes', 'messages', 'unreadCount', 'files', 'users', 'notifications'));
    }

    public function treasurerDashboard(Request $request)
    {
        // Handle setting the budget
        if ($request->isMethod('post') && $request->has('amount')) {
            $budget = new Budget();
            $budget->amount = $request->input('amount');
            $budget->save();
            return redirect()->route('dashboard.treasurer')->with('success', 'Budget set successfully.');
        }

        // Pass budget data to the view
        $budget = Budget::latest()->first();
        $notes = Note::all();
        $files = Storage::files('files');
        $users = User::all();
        $notifications = Notification::all();

        return view('dashboard.treasurer', ['budget' => $budget, 'notes' => $notes, 'files' => $files, 'users' => $users, 'notifications' => $notifications]);
    }

}
