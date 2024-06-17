<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="activities-tab" data-toggle="tab" href="#activities" role="tab" aria-controls="activities" aria-selected="false">Activities</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false">News</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="myTabsContent">

                <!-- Activities Tab Content -->
                <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                    <div class="d-flex justify-content-center my-5">
                        <a href="/signup" class="btn btn-primary nav-item {{ request()->is('signup') ? 'active' : '' }}">Sign up for an activity!</a>
                    </div>
                </div>

                <!-- News Tab Content -->
                <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
                    @include('dashboard.news')
                </div>


                <!-- Contact Tab Content -->
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @include('dashboard.contact')
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
