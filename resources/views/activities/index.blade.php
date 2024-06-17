@include("layouts.header")

@include("layouts.breadcrumb")

<div class="container-fluid events py-5">
    <div class="container py-5">
        <div class="pb-5">
            <div class="row g-4 align-items-end">
                <div class="col-xl-8">
                    <h2 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Activities</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($activities as $activity)
                <div class="col-md-12 mb-4">
                    <div class="card p-4">
                        <x-activity.list-item :activity="$activity"></x-activity.list-item>
                        <a href="{{ route('activities.show', $activity->id) }}" ></a>
                    </div>
                </div>
            @endforeach
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

@include("layouts.footer")
