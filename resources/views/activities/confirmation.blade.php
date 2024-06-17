@include("layouts.header")

<div class="container-fluid events py-5">
    <div class="container py-5">
        <div class="pb-5">
            <div class="row g-4 align-items-end">
                <div class="col-xl-8">
                    <h2 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Cancel attendance</h2>
                    <p>Are you sure that you want to cancel your attendance to this activity?</p>
                </div>
            </div>
            <form action="{{ route('cancellation', $activity) }}" method="POST">
                @csrf
                <div class="btn-group">
                    <div class="form-group">
                        <a type="button" href="{{ route('activities.show', $activity) }}" class="btn btn-primary">
                            No, i want to stay registered</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Yes, Please cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include("layouts.footer")
