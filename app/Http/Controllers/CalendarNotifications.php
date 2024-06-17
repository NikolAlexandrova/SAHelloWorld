<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarNotifications extends Controller
{
public function index()
{
$notifications = auth()->user()->unreadNotifications->unique('id');

return view('dashboard.notifications', compact('notifications'));
}
}
