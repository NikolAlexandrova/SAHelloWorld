<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="calendar-container">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="eventModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eventTitle" class="font-weight-bold">Title</label>
                        <input type="text" class="form-control" id="eventTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="eventStart" class="font-weight-bold">Start Date</label>
                        <input type="date" class="form-control" id="eventStart">
                    </div>
                    <div class="form-group">
                        <label for="eventEnd" class="font-weight-bold">End Date</label>
                        <input type="date" class="form-control" id="eventEnd">
                    </div>
                    <div class="form-group">
                        <label for="eventTags" class="font-weight-bold">Tags</label>
                        <input type="text" class="form-control" id="eventTags" placeholder="Enter tags">
                    </div>
                    <div class="form-group">
                        <label for="eventDescriptionInput" class="font-weight-bold">Description</label>
                        <textarea class="form-control" id="eventDescriptionInput" rows="5" placeholder="Add a description..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addComment" class="font-weight-bold">Add a comment</label>
                        <textarea class="form-control" id="addComment" rows="3" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventColor" class="font-weight-bold">Color</label>
                        <input type="color" class="form-control" id="eventColor" value="#007bff">
                    </div>
                    <input type="hidden" id="eventId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                    <button type="button" class="btn btn-danger d-none" id="deleteButton">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS and JS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/interaction.min.js'></script>

    <!-- JS for modal functionality -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .calendar-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            margin-top: 50px;
        }

        .modal-lg {
            max-width: 50% !important;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/api/calendars',
                selectable: true,
                editable: true,
                select: function(info) {
                    // Clear previous modal data
                    $('#modalTitle').text('Create Event');
                    $('#eventTitle').val('');
                    $('#eventStart').val(info.startStr);
                    // Correctly display the end date by subtracting one day for display purposes
                    $('#eventEnd').val(info.endStr ? new Date(new Date(info.endStr).setDate(new Date(info.endStr).getDate() - 1)).toISOString().split('T')[0] : '');
                    $('#eventTags').val('');
                    $('#eventDescriptionInput').val('');
                    $('#addComment').val('');
                    $('#eventColor').val('#007bff');
                    $('#eventId').val('');
                    $('#saveButton').data('action', 'create');
                    $('#deleteButton').addClass('d-none');
                    $('#eventModal').modal('show');
                    calendar.unselect();
                },
                eventClick: function(info) {
                    var eventObj = info.event;

                    $('#modalTitle').text('Edit Event');
                    $('#eventTitle').val(eventObj.title);

                    var startDate = new Date(eventObj.start);
                    startDate.setDate(startDate.getDate() + 1);
                    $('#eventStart').val(startDate.toISOString().split('T')[0]);

                    $('#eventEnd').val(eventObj.end ? eventObj.end.toISOString().split('T')[0] : '');
                    $('#eventTags').val(eventObj.extendedProps.tags);
                    $('#eventDescriptionInput').val(eventObj.extendedProps.description);
                    $('#addComment').val(eventObj.extendedProps.comments);
                    $('#eventColor').val(eventObj.backgroundColor);
                    $('#eventId').val(eventObj.id);
                    $('#saveButton').data('action', 'edit');
                    $('#deleteButton').removeClass('d-none');
                    $('#eventModal').modal('show');

                }
            });

            calendar.render();

            $('#saveButton').on('click', function() {
                var action = $(this).data('action');
                var eventId = $('#eventId').val();
                var title = $('#eventTitle').val();
                var start = $('#eventStart').val();
                // When saving, add one day to the end date to store correctly
                var end = $('#eventEnd').val() ? new Date(new Date($('#eventEnd').val()).setDate(new Date($('#eventEnd').val()).getDate() + 1)).toISOString().split('T')[0] : null;
                var description = $('#eventDescriptionInput').val();
                var tags = $('#eventTags').val();
                var comments = $('#addComment').val();
                var color = $('#eventColor').val();

                var eventData = {
                    title: title,
                    start: start,
                    end: end,
                    description: description,
                    tags: tags,
                    comments: comments,
                    color: color
                };

                if (action === 'create') {
                    fetch('/api/calendars', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(eventData)
                    })
                        .then(response => response.json())
                        .then(data => {
                            calendar.addEvent({
                                id: data.id,
                                title: data.title,
                                start: data.start,
                                end: data.end,
                                backgroundColor: data.color,
                                borderColor: data.color,
                                description: data.description,
                                tags: data.tags,
                                comments: data.comments
                            });
                            console.log('Event added successfully:', data);
                            $('#eventModal').modal('hide');
                        })
                        .catch(error => {
                            console.error('Error adding event:', error);
                            alert('There was an error adding the event. Please try again.');
                        });
                } else if (action === 'edit') {
                    fetch('/api/calendars/' + eventId, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(eventData)
                    })
                        .then(response => response.json())
                        .then(data => {
                            var event = calendar.getEventById(eventId);
                            event.setProp('title', title);
                            event.setExtendedProp('description', description);
                            event.setExtendedProp('tags', tags);
                            event.setExtendedProp('comments', comments);
                            event.setProp('backgroundColor', color);
                            event.setProp('borderColor', color);
                            event.setStart(start);
                            event.setEnd(end);
                            $('#eventModal').modal('hide');
                            console.log('Event updated successfully:', data);
                        })
                        .catch(error => {
                            console.error('Error updating event:', error);
                            alert('There was an error updating the event. Please try again.');
                        });
                }
            });

            $('#deleteButton').on('click', function() {
                var eventId = $('#eventId').val();
                fetch('/api/calendars/' + eventId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        var event = calendar.getEventById(eventId);
                        event.remove();
                        $('#eventModal').modal('hide');
                        console.log('Event deleted successfully:', data);
                    })
                    .catch(error => {
                        console.error('Error deleting event:', error);
                        alert('There was an error deleting the event. Please try again.');
                    });
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                if (target === "#calendar") {
                    calendar.render();
                }
            });
        });
    </script>
</x-dashboard-layout>
