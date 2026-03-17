@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>User Login</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">User Login</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->
<!-- login Area Start -->


<section class="login-section d-flex align-items-center mt-5 mb-5">
    <div class="container">
        <div class="row no-gutters shadow-lg rounded overflow-hidden bg-white">
            <div class="col-12 col-md-12 col-lg-12 {{ $errors->any() || session('success') ? 'pt-4 pl-4 pr-4' : '' }}">
                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger d-block align-items-center mb-2" role="alert">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <div><i class="fa fa-ban mr-2"></i>Error</div>
                                </div>
                                <div class="col-12 col-md-10 text-left">
                                    <p style="color: red;" class="mb-0">{{ $error }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success d-block align-items-center mb-0" role="alert">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div><i class="fa fa-check-circle mr-2"></i>Success</div>
                            </div>
                            <div class="col-12 col-md-10 text-left">
                                <p style="color: green;" class="mb-0">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Left Side -->
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-start p-5 login-info">
                <h3 class="font-weight-bold mb-4">Login to takemeon.lk</h3>
                <p class="text-muted mb-4">
                    To view your ads and account details, please login to your takemeon.lk account.
                </p>

                <div class="info-item d-flex align-items-start mb-4">
                    <div class="icon mr-3">
                        <img src="{{ url('public/assets/frontend/images/icons/1-1x-a2fc1800.png') }}" alt=""/>
                    </div>
                    <div class="align-self-center">
                        <h6 class="font-weight-semibold mb-1">
                            Start posting your own ads.
                        </h6>
                    </div>
                </div>

                <div class="info-item d-flex align-items-start mb-4">
                    <div class="icon mr-3">
                        <img src="{{ url('public/assets/frontend/images/icons/2-1x-3efcbe32.png') }}" alt=""/>
                    </div>
                    <div class="align-self-center">
                        <h6 class="mb-1">
                            Mark ads as favorite and view later.
                        </h6>
                    </div>
                </div>

                <div class="info-item d-flex align-items-start">
                    <div class="icon mr-3">
                        <img src="{{ url('public/assets/frontend/images/icons/3-1x-b04d6b82.png') }}" alt=""/>
                    </div>
                    <div class="align-self-center">
                        <h6 class="mb-1">
                            Manage your ads anytime.
                        </h6>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-6 p-5 login-form-wrapper">

                <div class="text-center mb-2">
                    <h4 class="font-weight-bold">Welcome Back</h4>
                </div>
                <div class="text-left mb-4">
                    <p><span class="text-danger">*</span> All Fields are Required</p>
                </div>

                <form action="{{ route('frontend.userloginform') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text"
                               class="form-control custom-input"
                               placeholder="Email or Username" name="username">
                    </div>

                    <div class="form-group">
                        <input type="password"
                               class="form-control custom-input"
                               placeholder="Password" name="password">
                    </div>

                    <button type="submit"
                            class="btn btn-login btn-block mb-3">
                        Login
                    </button>

                    <div class="text-center">
                        <a href="javascript:void(0)" class="btn-link cursor-pointer" id="btn_forgetpwd">
                            Forgot password?
                        </a>
                    </div>

                    <div class="text-center">
                        <p class="mb-2">or Login with</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('google.login') }}" class="d-flex align-items-center justify-content-center">
                            <svg viewBox="-3 0 262 262" width="25px" class="ml-5" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"></path><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"></path><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"></path><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"></path></g></svg>
                        Google
                        </a>
                        <a href="{{ route('facebook.login') }}" class="d-flex align-items-center justify-content-center">
                            <svg viewBox="0 0 48 48" width="25px" class="ml-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Facebook-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0"> <path d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z" id="Facebook"> </path> </g> </g> </g></svg>
                        Facebook
                        </a>
                    </div>

                    <hr>

                    <div class="text-center">
                        <p class="mb-2">Don't have an account?</p>
                        <a href="{{ route('frontend.userregister') }}" class="btn head-btn2 px-4">
                            Signup
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>

<!-- login Area End -->

@endsection

@push('css')
    <style>
        .p_star .placeholder{
            background-color: transparent !important;
        }

        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }

        .border-box{
            padding: 15px;
            border 2px solid #f79b20;
        }
        .about_sub_description{
            p{

            }
        }
        .about_description{
            p{
                border: 2px solid #e6b127;
                padding: 24px 20px;
                display: inline-block;
                height: 100%;
                vertical-align: top;
            }
        }
        @media (max-width: 2040px) {
            .about_description{
                p{
                    width: 49%;
                    height: 260px;
                }
            }
        }

        @media (max-width: 1440px) {
            .about_description{
                p{
                    width: 49%;
                    height: 350px;
                }
            }
        }

        @media (max-width: 720px) {
            .about_description{
                p{
                    width: 100%;
                    height: auto;
                }
            }
        }

        @media (max-width: 540px) {
            .about_description{
                p{
                    width: 100%;
                    height: auto;
                }
            }
        }

        @media (max-width: 200px) {
            .about_description{
                p{
                    width: 100%;
                    height: auto;
                }
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function FormModelDetails(title, body, cancel, ok = '', page_id = 0, action = null, method = 'POST') {
            $('#formModelLabel').text(title);
            $('#formModelBody').html(body);
            $('#formModelBtnCalcel').text(cancel);
            if (ok !== '') {
                $('#formModelBtnOk').text(ok).show();
            } else {
                $('#formModelBtnOk').hide();
            }
            $('#formPageId').val(page_id);
            $('#formModel form').attr('action', action);
            $('#formModel form').attr('method', method);
            console.log("Form Modal Open");
            var myFormModal = new bootstrap.Modal(document.getElementById('formModel'));
            myFormModal.show();
        }

        $(document).ready(function() {
            let step = 1;
            $('#btn_forgetpwd').on('click',function(){
                console.log('Click Button');
               
                let htmlElement = `<div class="row">
                                      <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control custom-input" placeholder="Enter Your Email or Username" name="username">
                                        </div>
                                      </div>
                                   </div>`;                 

                FormModelDetails('Forget Password', htmlElement, 'Cancel', 'Next', 0, '', 'POST');
                            
            });

            $('#formModalRooute').submit(function(e){

                e.preventDefault();

                var formData = $(this).serialize();
                var user_id = $('#formPageId').val();

                if(step === 1){

                    $.ajax({

                        url: '{{ route("forgot.password") }}',
                        method: 'POST',
                        data: formData,

                        success: function (res) {

                            if(res.status === 'otp_sent'){

                                let htmlElement = `<div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control custom-input"
                                            placeholder="Enter OTP" name="otp">
                                        </div>
                                    </div>
                                </div>`;

                                $('#formPageId').val(res.user_id);
                                step = 2;

                                Swal.fire({
                                    title: 'Success',
                                    text: "OTP sent successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {

                                    FormModelDetails(
                                        'OTP Verification',
                                        htmlElement,
                                        'Cancel',
                                        'Next',
                                        res.user_id,
                                        '',
                                        'POST'
                                    );

                                });

                            }else{

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    position: "bottom-end",
                                    text: res.message
                                });

                            }

                        },

                        error: function (xhr) {

                            alert(xhr.responseJSON?.message || 'Step 1 - Something went wrong!');

                        }

                    });

                }


                /*
                STEP 2
                */

                else if(step === 2){

                    $.ajax({

                        url: '{{ route("verify.resetotp") }}',
                        method: 'POST',
                        data: formData + '&user_id=' + user_id,

                        success: function (res) {

                            if(res.status === 'verified'){

                                let htmlElement = `<div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control custom-input"
                                            placeholder="Enter New Password" name="newpassword">
                                        </div>
                                    </div>
                                </div>`;

                                step = 3;

                                Swal.fire({
                                    title: 'Success',
                                    text: "Please enter your new password!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {

                                    FormModelDetails(
                                        'New Password',
                                        htmlElement,
                                        'Cancel',
                                        'Submit',
                                        user_id,
                                        '',
                                        'POST'
                                    );

                                });

                            }else{

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    position: "bottom-end",
                                    text: res.message
                                });

                            }

                        },

                        error: function (xhr) {

                            alert(xhr.responseJSON?.message || 'Step 2 - Something went wrong!');

                        }

                    });

                }


                /*
                STEP 3
                */

                else if(step === 3){

                    $.ajax({

                        url: '{{ route("reset.password") }}',
                        method: 'POST',
                        data: formData + '&user_id=' + user_id,

                        success: function (res) {

                            if(res.status === 'success'){

                                $('#formPageId').val('');

                                Swal.fire({
                                    title: 'Success',
                                    text: "Password reset successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {

                                    location.reload();

                                });

                            }else{

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    position: "bottom-end",
                                    text: res.message
                                });

                            }

                        },

                        error: function (xhr) {

                            alert(xhr.responseJSON?.message || 'Step 3 - Something went wrong!');

                        }

                    });

                }

            }); 

            // Increase quantity
            $('.input-number-increment').click(function () {
                let id = $(this).data('id');
                updateCartQuantity(id, 'increment');
            });

            // Decrease quantity
            $('.input-number-decrement').click(function () {
                let id = $(this).data('id');
                updateCartQuantity(id, 'decrement');
            });

            function updateCartQuantity(productId, action) {
                $.ajax({
                    url: '{{ route("frontend.cart.update") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        action: action
                    },
                    success: function (response) {
                        // Reload the cart view area
                        location.reload();
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON.message || 'Something went wrong!');
                    }
                });
            }
        });

    </script>
@endpush
