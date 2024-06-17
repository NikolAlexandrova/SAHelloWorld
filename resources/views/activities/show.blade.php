<x-app-layout>
    <div class="container-fluid events py-5">
        <div class="container py-5">
            <div class="pb-5">
                <div class="text-start mb-4">
                    <br>
                    <a href="{{ url()->previous() }}" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
                <div class="row g-4 align-items-end">
                    <div class="col-xl-8">
                        <h2 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">{!! $activity->title !!}</h2>
                    </div>
                </div>
                <br>
                <br>
                <p class="mb-3">{!! $activity->description !!}</p>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp">
                    <img src="/img/service-1.jpg" class="img-fluid rounded" alt="Image">
                </div>
                <br>
                <p class="mb-3"><strong>Location: </strong>{!! $activity->location !!}</p>
                <p class="mb-3"><strong>Starting time:</strong> {!! $activity->starting_time !!}</p>
                <p class="mb-3"><strong>Ending time:</strong> {!! $activity->starting_time !!}</p>
                <p class="mb-3"><strong>Date:</strong> {!! $activity->date !!}</p>
                <p class="mb-3"><strong>Participant limit:</strong> {!! $activity->allowed_participants !!}</p>
                <br>

                @php
                    $rolesWithDiscount = ['chairman','secretary','treasurer','head of media','head of activities','media team member',
                    'activities committee member','paid member','board member'];
                    $displayAmount = Auth::check() && Auth::user()->hasAnyRole($rolesWithDiscount) && isset($activity->discounted_amount) ? $activity->discounted_amount : $activity->amount;
                @endphp

                <p><strong>Price: </strong> €{{ $displayAmount }}</p>
                <br>

                <div>
                    @if(Auth::check())
                        @if(Auth::user()->activities->contains($activity))
                            <form method="POST" action="{{ route('confirmation', ['activity' => $activity]) }}">
                                @csrf
                                <button class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0" type="submit">Cancel</button>
                            </form>
                            <br>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        @else
                            <!-- Payment Form -->
                            <form id="payment-form" action="{{ route('process', ['activity' => $activity]) }}" method="POST">
                                @csrf
                                <button id="pay-button" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Register and Pay</button>
                            </form>
                            <!-- End Payment Form -->
                            <br>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        @endif
                    @else
                        <p>You need to have an account to register for the activity</p>
                        <div class="btn-group">
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Create an account</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include("layouts.footer")
</x-app-layout>


@push('scripts')
    <script>
        // Prevent form submission and handle payment asynchronously
        $('#payment-form').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Make an AJAX request to process the payment
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Redirect to payment success handling route
                    window.location.href = response.redirect_url;
                },
                error: function(response) {
                    // Handle errors
                    console.error(response);
                    alert('Payment initiation failed. Please try again.');
                }
            });
        });
    </script>
@endpush
