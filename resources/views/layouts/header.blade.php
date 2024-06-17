<!DOCTYPE html>
<html lang="en">

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
    <link href="{{ URL::asset('css/bootstrap.min.css'); }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::asset('css/style.css'); }} " rel="stylesheet">
</head>

<body>

{{--<!-- Spinner Start -->--}}
{{--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">--}}
{{--    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">--}}
{{--        <span class="sr-only">Loading...</span>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- Spinner End -->--}}


<!-- Topbar Start -->
{{--<div class="container-fluid bg-secondary px-5 d-none d-lg-block">--}}
{{--    <div class="row gx-0 align-items-center" style="height: 45px;">--}}
{{--        <div class="col-lg-8 text-center text-lg-start mb-lg-0">--}}
{{--            <div class="d-flex flex-wrap">--}}
{{--                <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+000 000 00000</a>--}}
{{--                <a href="#" class="text-light me-0"><i class="fas fa-envelope text-primary me-2"></i>info@svhelloworld.nl</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 text-center text-lg-end">--}}
{{--            <div class="d-flex justify-content-end">--}}
{{--                <div class="border-end border-start py-1">--}}
{{--                    <a href="https://www.facebook.com/svhelloworld/" class="btn text-primary"><i class="fab fa-facebook-f"></i></a>--}}
{{--                </div>--}}
{{--                <div class="border-end py-1">--}}
{{--                    <a href="https://x.com/svhelloworld" class="btn text-primary"><i class="fab fa-twitter"></i></a>--}}
{{--                </div>--}}
{{--                <div class="border-end py-1">--}}
{{--                    <a href="https://www.instagram.com/svhelloworld/" class="btn text-primary"><i class="fab fa-instagram"></i></a>--}}
{{--                </div>--}}
{{--                <div class="border-end py-1">--}}
{{--                    <a href="#" class="btn text-primary"><i class="fab fa-linkedin-in"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Topbar End -->

<style>
    .logo-image {
        max-height: 150px; /* Adjust the height as needed */
        max-width: 300px; /* Adjust the width as needed */
    }
</style>
<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
            <img src="/img/SA Hello World logo.png" alt="SA Hello Logo" class="img-fluid" style="max-height: 100px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : ''}}">Home</a>
                <a href="/about" class="nav-item nav-link {{ request()->is('about') ? 'active' : ''}}">About</a>
                <a href="/activities" class="nav-item nav-link {{ request()->is('activities') ? 'active' : ''}}">Activities</a>

                <a href="/news" class="nav-item nav-link {{ request()->is('news') ? 'active' : ''}}">News</a>
                <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : ''}}">Contact Us</a>
            </div>
            <a href="/register" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Register</a>
            <a href="/login" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Login</a>
        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->
