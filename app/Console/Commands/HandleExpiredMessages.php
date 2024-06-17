<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MessageReminderNotification;

class HandleExpiredMessages extends Command
{
    protected $signature = 'messages:handle-expiry';
    protected $description = 'Handle expired messages and send reminders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Delete messages older than 30 days
        Message::where('created_at', '<', now()->subDays(30))->delete();


        // Send reminders for unread messages older than 10 days
        $unreadMessages = Message::where('created_at', '<', now()->subDays(1))
            ->where('is_read', false)
            ->get();

        foreach ($unreadMessages as $message) {
            Notification::route('mail', 'secretary@example.com')
                ->notify(new MessageReminderNotification($message));
        }
    }
}

