<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Hello World SV</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Yantramanav:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::asset('css/style.css') }} " rel="stylesheet">

    <!-- Alpine.js for dropdown functionality (if required) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js" defer></script>
</head>
<body class="font-sans antialiased">
<div class="container-fluid bg-secondary px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center" style="height: 45px;">
        <div class="col-lg-8 text-center text-lg-start mb-lg-0">
            <div class="d-flex flex-wrap">
                <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+000 000 00000</a>
                <a href="#" class="text-light me-0"><i class="fas fa-envelope text-primary me-2"></i>info@svhelloworld.nl</a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-flex justify-content-end">
                <div class="border-end border-start py-1">
                    <a href="https://www.facebook.com/svhelloworld/" class="btn text-primary"><i class="fab fa-facebook-f"></i></a>
                </div>
                <div class="border-end py-1">
                    <a href="https://x.com/svhelloworld" class="btn text-primary"><i class="fab fa-twitter"></i></a>
                </div>
                <div class="border-end py-1">
                    <a href="https://www.instagram.com/svhelloworld/" class="btn text-primary"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="border-end py-1">
                    <a href="#" class="btn text-primary"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
            <img src="/img/SA Hello World logo.png" alt="SA Hello Logo" class="img-fluid" style="height: 400px !important; width: auto !important;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                @auth
                    <!-- Chairman -->
                    @if(auth()->user()->hasRole('chairman'))
                        <a href="/dashboard/chairman" class="nav-item nav-link {{ request()->is('dashboard/chairman*') ? 'active' : '' }}">Chairman</a>
                    @endif

                    <!-- Secretary -->
                    @if(auth()->user()->hasRole('secretary'))
                        <a href="/dashboard/secretary" class="nav-item nav-link {{ request()->is('dashboard/secretary*') ? 'active' : '' }}">Secretary</a>
                    @endif

                    <!-- Activities Committee Member -->
                    @if(auth()->user()->hasRole('activities committee member'))
                        <a href="/dashboard/activitiesCommitteeMember" class="nav-item nav-link {{ request()->is('dashboard/activitiesCommitteeMember*') ? 'active' : '' }}">Activities Committee Member</a>
                    @endif

                    <!-- Board Member -->
                    @if(auth()->user()->hasRole('board member'))
                        <a href="/dashboard/boardMember" class="nav-item nav-link {{ request()->is('dashboard/boardMember*') ? 'active' : '' }}">Board Member</a>
                    @endif

                    <!-- Head of Activities -->
                    @if(auth()->user()->hasRole('head of activities'))
                        <a href="/dashboard/headOfActivities" class="nav-item nav-link {{ request()->is('dashboard/headOfActivities*') ? 'active' : '' }}">Head of Activities</a>
                    @endif

                    <!-- Media Team Member -->
                    @if(auth()->user()->hasRole('media team member'))
                        <a href="/dashboard/mediaTeamMember" class="nav-item nav-link {{ request()->is('dashboard/mediaTeamMember*') ? 'active' : '' }}">Media Team Member</a>
                    @endif

                    <!-- Head of Media -->
                    @if(auth()->user()->hasRole('head of media'))
                        <a href="/dashboard/headOfMedia" class="nav-item nav-link {{ request()->is('dashboard/headOfMedia*') ? 'active' : '' }}">Head Of Media</a>
                    @endif

                    <!-- Paid Member -->
                    @if(auth()->user()->hasRole('paid member'))
                        <a href="/dashboard/paidMember" class="nav-item nav-link {{ request()->is('dashboard/paidMember*') ? 'active' : '' }}">Member</a>
                    @endif

                    <!-- Treasurer -->
                    @if(auth()->user()->hasRole('treasurer'))
                        <a href="/dashboard/treasurer" class="nav-item nav-link {{ request()->is('dashboard/treasurer*') ? 'active' : '' }}">Treasurer</a>
                    @endif
                @endauth

                <!-- Dashboard -->
                <a href="/dashboard" class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>

                <!-- Settings Dropdown -->
                @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</div>

<!-- Page Heading -->
@if (isset($header))
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endif

<!-- Page Content -->
<main>
    {{ $slot }}
</main>
</body>
</html>
