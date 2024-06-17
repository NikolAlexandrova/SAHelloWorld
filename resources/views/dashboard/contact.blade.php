<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="pb-5">
                <h4 class="text-secondary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Contact Us</h4>
                <h1 class="display-2 mb-0 wow fadeInUp" data-wow-delay="0.3s">Get In Touch</h1>
            </div>
            <div class="bg-light rounded p-4 pb-0">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <h2 class="display-5 mb-2">Form</h2>
                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with PHP in a few minutes...</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="phone" class="form-control" id="phone" placeholder="Phone">
                                        <label for="phone">Your Phone</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="project" placeholder="Project">
                                        <label for="project">Your Project</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 160px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                        <div class="d-flex align-items-center mb-5">
                            <div class="mb-3"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></div>
                            <div class="ms-4">
                                <h4>Addresses</h4>
                                <p class="mb-0">Het Groene Woud 1, 4331 NB Middelburg</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="mb-3"><i class="fa fa-phone-alt fa-2x text-primary"></i></div>
                            <div class="ms-4">
                                <h4>Mobile</h4>
                                <p class="mb-0">+000 000 00000</p>
                                <p class="mb-0">+000 000 00000</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="mb-3"><i class="fa fa-envelope-open fa-2x text-primary"></i></div>
                            <div class="ms-4">
                                <h4>Email</h4>
                                <p class="mb-0">info@example.com</p>
                                <p class="mb-0">info@example.com</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <i class="fas fa-share-alt fa-2x text-primary"></i>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-lg-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
