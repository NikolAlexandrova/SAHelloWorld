<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
public function index()
{
$messages = Message::where('created_at', '>', now()->subDays(30))->orderBy('created_at','desc')->paginate(2); // Paginate if necessary
$unreadCount = Message::where('created_at', '<=', now()->subDays(10))->where('is_read', false)->count();
return view('dashboard.secretary', compact('messages', 'unreadCount'));
}

public function all()
{
$messages = Message::where('created_at', '>', now()->subDays(30))->orderBy('created_at','desc')->paginate(10); // Paginate if necessary
return view('dashboard.message_all', compact('messages'));
}

public function view($id)
{
$message = Message::findOrFail($id);
$message->is_read = true;
$message->save();

return view('dashboard.message', compact('message'));
}

public function delete($id)
{
$message = Message::findOrFail($id);
$message->delete();

return redirect()->route('notifications')->with('success', 'Message deleted successfully!');
}

public function reminders()
{
$messages = Message::where('created_at', '<=', now()->subDays(10))->where('is_read', false)->orderBy('created_at','asc')->paginate(10); // Paginate if necessary
return view('dashboard.reminders', compact('messages'));
}
}
