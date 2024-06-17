<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TaskAddedNotification;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
public function fetchCalendars(Request $request)
{
try {
$calendars = Calendar::all();
return response()->json($calendars);
} catch (\Exception $e) {
Log::error('Error fetching calendars: ' . $e->getMessage());
return response()->json(['error' => 'Internal Server Error'], 500);
}
}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'nullable|date',
                'description' => 'nullable|string',
                'tags' => 'nullable|string',
                'comments' => 'nullable|string',
                'color' => 'nullable|string|max:7',
            ]);

            $calendar = Calendar::create($validatedData);

            $users = User::all();
            foreach ($users as $user) {
                Log::info('Sending notification to user ID: ' . $user->id);
                $user->notify(new TaskAddedNotification($calendar));
            }

            Log::info('Calendar entry created: ', $calendar->toArray());

            return response()->json($calendar);
        } catch (\Exception $e) {
            Log::error('Error storing calendar: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

public function update(Request $request, $id)
{
    try {
    $validatedData = $request->validate([
    'title' => 'required|string|max:255',
    'start' => 'required|date',
    'end' => 'nullable|date',
    'description' => 'nullable|string',
    'tags' => 'nullable|string',
    'comments' => 'nullable|string',
    'color' => 'nullable|string|max:7',
    ]);

    $calendar = Calendar::findOrFail($id);
    $calendar->update($validatedData);
    return response()->json($calendar);
    } catch (\Exception $e) {
    Log::error('Error updating calendar: ' . $e->getMessage());
    return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

public function destroy($id)
{
try {
$calendar = Calendar::findOrFail($id);
$calendar->delete();
return response()->json(['message' => 'Event deleted successfully']);
} catch (\Exception $e) {
Log::error('Error deleting calendar: ' . $e->getMessage());
return response()->json(['error' => 'Internal Server Error'], 500);
}
}
}
