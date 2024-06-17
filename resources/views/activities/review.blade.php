<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Creation') }}
        </h2>
    </x-slot>

    <div class="container-fluid events py-5">
        <div class="container py-5">
            <div class="pb-5">
                <form class="form-control" action="{{ route('activities.review') }}" method="POST">

                @csrf
                    <h2 class="text-primary sub-title fw-bold wow fadeInUp">Create a new Activity</h2>
                    <br>

                    {{-- Below are all the form fields --}}
                    <div class="form-group">
                        <label for="title" class="control-label col-sm-2">Title</label>
                        <div class="control has-icons-right">
                            <input type="text" name="title" placeholder="Enter the title..."
                                   class="form-control @error('title') is-danger @enderror"
                                   value="{{ old('title') }}" autocomplete="title">
                            @error('title')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('title')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="control-label">Summary</label>
                        <div class="control has-icons-right">
                            <textarea type="text" name="summary" placeholder="Enter the summary..."
                                      class="form-control @error('summary') is danger @enderror"
                                      value="{{ old('summary') }}" autocomplete="summary" rows="5"></textarea>
                            @error('summary')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('summary')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <div class="control has-icons-right">
                            <textarea type="text" name="description" placeholder="Enter the description..."
                                      class="form-control @error('description') is danger @enderror"
                                      value="{{ old('description') }}" autocomplete="description" rows="10"></textarea>
                            @error('description')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location" class="control-label">Location</label>
                        <div class="control has-icons-right">
                            <input type="text" name="location" placeholder="Enter the location..."
                                   class="form-control @error('location') is danger @enderror"
                                   value="{{ old('location') }}" autocomplete="location">
                            @error('location')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('location')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="allowed_participants" class="control-label">Allowed Participants</label>
                        <div class="control has-icons-right">
                            <input type="number" name="allowed_participants" placeholder="Enter the number of allowed participants..."
                                   class="form-control @error('allowed_participants') is danger @enderror"
                                   value="{{ old('allowed_participants') }}" autocomplete="allowed_participants">
                            @error('allowed_participants')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('allowed_participants')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="starting_time" class="control-label">Time</label>
                        <div class="control has-icons-right">
                            <input type="time" name="starting_time" placeholder="Enter the starting time..."
                                   class="form-control @error('starting_time') is danger @enderror"
                                   value="{{ old('starting_time') }}" autocomplete="starting_time">
                            @error('starting_time')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('starting_time')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date" class="control-label">Time</label>
                        <div class="control has-icons-right">
                            <input type="date" name="date" placeholder="Enter the date..."
                                   class="form-control @error('date') is danger @enderror"
                                   value="{{ old('date') }}" autocomplete="date">
                            @error('date')
                            <span class="icon has-text-danger is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('date')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="btn-group">
                        <div class="control">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                        <div class="control">
                            <a type="button" href="{{ route('activities.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="control">
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include("layouts.footer")
</x-dashboard-layout>

