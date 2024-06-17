<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a list of activities
     */
    public function index()
    {
        $activities = Activity::all();

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new activity
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a new, created activity in storage
     */
    public function store(Request $request, Activity $activity)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'allowed_participants' => 'required|integer',
            'starting_time' => 'required|date_format:H:i',
            'ending_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'discounted_amount' => 'nullable|numeric|min:0', // Validate discounted amount if provided
        ]);


        $activity = Activity::create($validatedData);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Activity created successfully.');
    }


    /**
     * Display a specific activity
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing a specific activity
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity in storage
     */
    public function update(Request $request, Activity $activity)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'allowed_participants' => 'required|integer',
            'starting_time' => 'required|date_format:H:i',
            'ending_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'amount' => 'required|integer',
            'discounted_amount' => 'nullable|numeric|min:0', // Validate discounted amount if provided
        ]);
        // Update activity
        $activity->update($validatedData);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard.headOfActivities')->with('success', 'Activity updated successfully.');
    }

    /**
     * Show the form for deleting the specified activity
     */
    public function delete(Activity $activity)
    {
        return view('activities.delete', compact('activity'));
    }

    /**
     * Remove the specified activity from storage
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        // Redirect to signup page with success message
        return redirect()->route('signup')->with('success', 'Activity successfully deleted');
    }

    /**
     * Display the sign-up page for an activity
     */
    public function signup(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }
}
