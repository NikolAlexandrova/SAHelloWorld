<x-dashboard-layout>
    <div class="container mt-4">
        @if($notifications->isEmpty())
            <p>No new notifications.</p>
        @else
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item">
                        {{ $notification->data['message'] }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-dashboard-layout>
