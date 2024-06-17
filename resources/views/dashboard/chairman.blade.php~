<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chairman Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome Chairman") }}

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="false">Budget</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Files</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">Notifications</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">Calendar</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-4">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <h3>Overview</h3>
                            <p>This is the overview tab content.</p>
                        </div>

                        <!-- Notifications Tab Content -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                            @include('dashboard.notifications')
                        </div>


                        <!-- Reports Tab -->
                        <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                            <h3>Reports</h3>
                            <ul class="mt-4">
                                @foreach ($notes as $note)
                                    <li>
                                        <strong>{{ $note->title }}</strong> ({{ $note->created_at->format('Y-m-d') }})
                                        <a href="{{ route('notes.download', $note->id) }}" class="btn btn-secondary btn-sm ms-2">Download PDF</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Budget Tab -->
                        <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                            @if($budget)
                                <p>Budget for the student association is currently €{{ $budget->amount }}</p>
                            @else
                                <p>No budget set.</p>
                            @endif
                        </div>

                        <!-- Users Tab -->
                        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                            <!-- Display the list of users -->
                            <table class="table table-bordered mt-4">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
                            @include('dashboard.calendar')
                        </div>

                        <!-- Files Tab -->
                        <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
                            <!-- Sub-Tabs Navigation -->
                            <ul class="nav nav-tabs" id="fileSubTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">Upload</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="share-tab" data-toggle="tab" href="#share" role="tab" aria-controls="share" aria-selected="false">Share</a>
                                </li>
                            </ul>

                            <!-- Sub-Tabs Content -->
                            <div class="tab-content mt-4">
                                <!-- Upload Tab Content -->
                                <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                                    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Choose file</label>
                                            <input type="file" class="form-control" id="file" name="file" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                </div>
                                <!-- Share Tab Content -->
                                <div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="share-tab">
                                    <form action="{{ route('share.files') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="shared_files">Select files to share</label>
                                            <select multiple class="form-control" id="shared_files" name="shared_files[]" required>
                                                @foreach ($files as $file)
                                                    <option value="{{ $file }}">{{ basename($file) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="users">Select users to share with</label>
                                            <select multiple class="form-control" id="users" name="users[]" required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Share Files</button>

                                        @isset($mailtoLinks)
                                            @foreach($mailtoLinks as $link)
                                                <a href="{{ $link }}" class="btn btn-secondary">Share via Email</a>
                                                <br>
                                            @endforeach
                                        @endisset
                                    </form>
                                </div>

                                <!-- List of files -->
                            <ul class="mt-4">
                                @foreach ($files as $file)
                                    <li>
                                        <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a>
                                    </li>
                                @endforeach
                            </ul>
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

        $(document).ready(function () {
            // Initialize main tab and sub-tabs
            $('#fileSubTabs a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>

</x-app-layout>
