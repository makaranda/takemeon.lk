@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Enroll</h3>
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
                        <h3>Enroll</h3>
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
                {{--  
                <div class="col-12 col-md-12 mt-35 align-self-start">
                    <img src="{{ url('public/assets/uploads/pages/'.$enroll['feature_image']) }}" alt="IWGC Enroll" class="img-fluid"/>
                </div> 
                --}}
                <div class="col-12 col-md-12 mt-35 align-self-start">
                    {!! $enroll['sub_description'] !!}
                </div> 
                <div class="col-12 col-md-12 align-self-start description">
                    {!! $enroll['description'] !!}
                </div>  
                <div class="col-6 col-md-4 align-self-start">
                    <div class="row">
                        <!--<div class="col-12 col-md-12">
                            <i class="fa fa-university"></i> Application & Checklist
                        </div>-->
                        <div class="col-12 col-md-12 mt-10 mt-30">
                            @if ($application_form)
                                @foreach ($application_form as $form)
                                    <p class="mt-0 mb-0">
                                        <a href="{{ url('public/assets/frontend/applications/' . $form->file_name) }}" target="_blank" class="button button-contactForm btn_4 boxed-btnk bg-color2">Application & Checklist</a>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 align-self-start mt-30">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <a href="{{ route('frontend.payonline') }}" class="button button-contactForm btn_4 boxed-btn bg-color2">Pay Online</a>
                        </div>
                    </div>
                </div>    
                <!--<div class="col-12 col-md-9 mt-35">
                    <form class="form-contact contact_form" action="{{ route('frontend.contactsubmit') }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder = 'Enter your name'>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-8">
                                <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder = 'Enter email address'>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-8">
                                <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Subject'" placeholder = 'Enter your Subject'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mt-8">
                                <input class="form-control" name="phone" id="phone" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone'" placeholder = 'Enter Phone'>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-8">
                                  <label for="formFileMultiple" class="form-label">Upload Multiple files</label>
                                  <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-8">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder = 'Enter Message'></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                @error('g-recaptcha-response')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-10">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn">Send Message</button>
                        </div>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
    <!--/ about_area  -->

<!-- Enroll Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="enrollModalLabel">Notice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <strong>Enroll now, admission open</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>


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
        .bg-color2 {
            background-color: #be8a0b !important;
            &:hover{
                background-color: #1c2951 !important;
            }
        }
        .section_padding
            .description{
                img {
                    margin: 30px;
                    border: 2px solid #e4b22e;
                    padding: 3%;
                    width: 86% !important;
                }
            }
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
<script>
    //document.addEventListener("DOMContentLoaded", function () {
        /*setTimeout(function () {
            var enrollModal = new bootstrap.Modal(document.getElementById('enrollModal'));
            enrollModal.show();
        }, 5000);*/
        // 5000ms = 5 seconds
    //});
</script>>
@endpush
