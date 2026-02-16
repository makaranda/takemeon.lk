@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Pay Online</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

     <!-- about_area  -->
     <div class="about_area pb-5 mt-25 mb-25 contact-section section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-12">
                    <div class="about_info pl-0">
                        <h3>Pay Online</h3>
                        <p class="pt-0 mb-0"></p>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100 p-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn btn-link text-dark flaot-right" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-times"></i></button>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-12 mt-35">
                    <form class="form-contact contact_form" action="{{ route('frontend.contactsubmit') }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="st_id" id="st_id" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Student ID'" placeholder = 'Enter Student ID'>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-8">
                                <input class="form-control" name="st_name" id="st_name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Student Name'" placeholder = 'Student Nmae' readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="st_email" id="st_email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" placeholder = 'Email address' readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="st_phone" id="st_phone" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile'" placeholder = 'Mobile' readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="st_course" id="st_course" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Course'" placeholder = 'Course' readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                @error('g-recaptcha-response')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group-2 mt-10">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ about_area  -->




    <!-- gallery -->

    <!--/ gallery -->

@endsection

@push('css')
    <style>
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
    </style>
@endpush


@push('scripts')

<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute("{{ config('services.recaptcha.site') }}", { action: 'submit' }).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });

    $(document).ready(function() {
        $('#contactForm').validate({
            rules: {
                name: { required: true, minlength: 2 },
                subject: { required: true, minlength: 4 },
                email: { required: true, email: true },
                message: { required: true, minlength: 20 }
            },
            messages: {
                name: { required: "Your name is required", minlength: "Name must be at least 2 characters long" },
                subject: { required: "Please provide a subject", minlength: "Subject must be at least 4 characters long" },
                email: { required: "Please provide an email address" },
                message: { required: "Message is required", minlength: "Message must be at least 20 characters long" }
            }
        });
    });
</script>
@endpush
