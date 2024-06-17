<div class="row g-4 justify-content">
    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="event-item rounded">
            <div class="position-relative">
                <img src="/img/service-1.jpg" class="img-fluid rounded-top w-100" alt="Image">
                <div class="bg-primary text-white fw-bold rounded d-inline-block position-absolute p-2" style="top: 0; right: 0;">{!! $activity->date !!}</div>
                <div class="d-flex justify-content-between border-start border-end bg-white px-2 py-2 w-100 position-absolute" style="bottom: 0; left: 0; opacity: 0.8;">
                    <p class="text-dark"><i class="fas fa-clock text-primary"></i> {!! $activity->starting_time !!}</p>
                    <p class="text-dark"><span class="fas fa-map-marker-alt text-primary"></span> {!! $activity->location !!}</p>
                </div>
            </div>
            <div class="border border-top-0 rounded-bottom p-4">
                <p class="h4 mb-3 ">{!! $activity->title !!}</p>
                <p class="mb-3">{!! $activity->summary !!}</p>
                <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{route('activities.show',$activity)}}">View details</a>
            </div>
        </div>
    </div>
</div>
