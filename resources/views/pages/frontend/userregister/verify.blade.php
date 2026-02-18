@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>OTP Verify</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">OTP Verify</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->

<!-- Register Area Start -->

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
                <h3 class="font-weight-bold mb-4">OTP Verify to takemeon.lk</h3>
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

                <form action="{{ route('frontend.verifyOtpSubmit') }}" method="POST" class="register-form-box">
                        @csrf
                    <input type="hidden" name="user_id" value="{{ $id }}">
                    <!-- Single Input Fields -->
                    <div class="input-box">
                        <div class="form-group">
                            <input type="text" placeholder="Enter OTP" value="{{ old('otp') }}" name="otp" class="form-control custom-input">
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-login btn-block mb-3">
                        Verify
                    </button>

                </form>
            </div>

        </div>
    </div>
</section>

<!-- Register Area End -->

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
        $(document).ready(function() {
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
