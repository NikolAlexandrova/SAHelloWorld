@include("layouts.header")

<div class="container-fluid events py-5">
    <div class="container py-5">
        <div class="pb-5">
            <div class="row g-4 align-items-end">
                <div class="col-xl-8">
                    <h2 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Delete {!! $activity->title !!}</h2>
                    <p>Are you sure that you want to delete this activity?</p>
                </div>
            </div>
            <form action="{{ route('activities.destroy', $activity) }}" method="POST">
                @csrf
                @method("DELETE")
                <div class="btn-group">
                    <div class="form-group">
                        <a type="button" href="{{ route('activities.show', $activity) }}" class="btn btn-primary">Cancel</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include("layouts.footer")
