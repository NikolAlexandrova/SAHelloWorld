<!-- Contact Start -->
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
                    <p class="mb-4">Please ensure that all of the required fields marked with a red asterix (*) are filled out.</p>
                    <div id="confirmation-message" class="alert alert-success" style="display:none;"></div>
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{Session::get('flash_message')}}</div>
                    @endif
                    <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name <span class="text-danger">*</span></label>
                                    @if($errors->has('name'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email <span class="text-danger">*</span></label>
                                    @if($errors->has('email'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('email')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                                    <label for="phone">Your Phone <span class="text-danger">*</span></label>
                                    @if($errors->has('phone'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('phone')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="project" name="project" placeholder="Project">
                                    <label for="project">Your Project</label>
                                    @if($errors->has('project'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('project')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject <span class="text-danger">*</span></label>
                                    @if($errors->has('subject'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('subject')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 160px" required></textarea>
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                    @if($errors->has('message'))
                                        <small class = 'form-text invalid-feedback'>{{$errors->first('message')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3">Send Message</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Show the confirmation message
                    $('#confirmation-message').text('Your message has been sent successfully!').show();

                    // Optionally, you can clear the form fields
                    $('#contact-form')[0].reset();
                },
                error: function(response) {
                    // Handle errors here
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

<style>
    .invalid-feedback{
        display: block;
    }
    .text-danger{
        color: red;
    }
</style>
<!-- Contact End -->
