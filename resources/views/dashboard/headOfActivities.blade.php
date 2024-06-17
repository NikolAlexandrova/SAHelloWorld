<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Head of Activities Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome HOA") }}

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mt-4" id="headofmediaTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="activities-tab" data-toggle="tab" href="#activities" role="tab" aria-controls="activities" aria-selected="true">Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="false">Budget</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="manage-activities-tab" data-toggle="tab" href="#manage-activities" role="tab" aria-controls="manage-activities" aria-selected="false">Manage Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">Calendar</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-4">
                        <!-- Activities Tab -->
                        <div class="tab-pane fade show active" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                            @include('activities.create')
                        </div>

                        <!-- Notes Tab -->
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <form action="{{ route('notes.save') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="meeting_notes">Meeting Notes</label>
                                    <textarea id="meeting_notes" name="meeting_notes" class="form-control" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Save Notes</button>
                            </form>
                            <div class="mt-4">
                                <h1>Saved Notes</h1>
                                @isset($notes)
                                    <ul>
                                        @foreach ($notes as $note)
                                            <li>
                                                {{ $note->created_at }} - {{ $note->title }}: {{ $note->content }}
                                                <a href="{{ route('notes.download', $note->id) }}" class="btn btn-secondary btn-sm ms-2">Download PDF</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endisset
                            </div>
                        </div>

                        <!-- Notifications Tab -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                            @include('dashboard.notifications')
                        </div>

                        <!-- Budget Tab -->
                        <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                            @if($budget)
                                <p>Budget for the student association is currently €{{ $budget->amount }}</p>
                            @else
                                <p>No budget set.</p>
                            @endif
                        </div>

                        <!-- Manage Activities Tab -->
                        <div class="tab-pane fade" id="manage-activities" role="tabpanel" aria-labelledby="manage-activities-tab">
                            <table class="table mt-4">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start Time</th>
                                    <th>Date</th>
                                    <th>Summary</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->title }}</td>
                                        <td>{{ $activity->starting_time }}</td>
                                        <td>{{ $activity->date }}</td>
                                        <td>{{ $activity->summary }}</td>
                                        <td>{{ $activity->location }}</td>
                                        <td>
                                            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Calendar Tab -->
                        <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
                            @include('dashboard.calendar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Activate tab functionality
            $('.nav-tabs a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
</x-app-layout>
