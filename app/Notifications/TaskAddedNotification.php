<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Calendar;

class TaskAddedNotification extends Notification implements ShouldQueue
{
use Queueable;

protected $calendar;

public function __construct(Calendar $calendar)
{
$this->calendar = $calendar;
}

public function via($notifiable)
{
return ['database'];
}

public function toArray($notifiable)
{
return [
'title' => 'New Task Added',
'message' => 'A new task "' . $this->calendar->title . '" has been added to the calendar.',
'calendar_id' => $this->calendar->id,
];
}
}
