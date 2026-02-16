@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->
<div class="hero-area section-bg2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slider-area">
                    <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                        <div class="hero-caption hero-caption2">
                            <h2>Checkout</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->

<!-- Checkout Area Start-->
<section class="checkout_area">
    <div class="container">
        {{-- <div class="returning_customer">
            <div class="check_title">
                <h2>
                    Returning Customer?

                    <a href="login.html">Click here to login</a>
                </h2>
            </div>
            <p>
                If you have shopped with us before, please enter your details in the
                boxes below. If you are a new customer, please proceed to the
                Billing & Shipping section.
            </p>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" id="name" name="name" value=" " />
                    <span class="placeholder" data-placeholder="Username or Email"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                    <input type="password" class="form-control" id="password" name="password" value="" />
                    <span class="placeholder" data-placeholder="Password"></span>
                </div>
                <div class="col-md-12 form-group d-flex flex-wrap">
                    <a href="login.html" value="submit" class="btn" > log in</a>
                    <div class="checkout-cap ml-5">
                        <input type="checkbox" id="fruit01" name="keep-log">
                        <label for="fruit01">Create an account?</label>
                    </div>
                </div>
            </form>
        </div> --}}
        {{-- <div class="cupon_area">
            <div class="check_title">
                <h2> Have a coupon?
                    <a href="#">Click here to enter your code</a>
                </h2>
            </div>
            <input type="text" placeholder="Enter coupon code" />
            <a class="btn" href="#">Apply Coupon</a>
        </div> --}}
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="name" value="{{ Auth::user()->name }}" placeholder="First name" readonly/>
                            <span class="placeholder" data-placeholder="First name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" value="{{ Auth::user()->phone }}" name="number" placeholder="Phone number" readonly/>
                            <span class="placeholder" data-placeholder="Phone number"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ Auth::user()->email }}" readonly/>
                            <span class="placeholder" data-placeholder="Email Address"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="8">Sri Lanka</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ Auth::user()->address }}" readonly/>
                            <span class="placeholder" data-placeholder="Address"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City"/>
                            <span class="placeholder" data-placeholder="Town/City"></span>
                        </div>
                        <div class="col-md-12 form-group p_star2 mb-0">
                            <select class="form-control country_select2" id="district" name="district">
                                @if ($districts->count() > 0)
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
                        </div>
                        {{-- <div class="col-md-12 form-group">
                            <div class="checkout-cap">
                                <input type="checkbox" id="fruit1" name="keep-log">
                                <label for="fruit1">Create an account?</label>
                            </div>
                        </div> --}}
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <h3>Shipping Details</h3>
                                <div class="checkout-cap">
                                    <input type="checkbox" id="different_address" name="different_address" />
                                    <label for="different_address">Ship to a different address?</label>
                                </div>
                            </div>
                            <textarea class="form-control" name="other_address" id="other_address" rows="1" placeholder="Other Address"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                                <a href="#">Product<span>Total</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Fresh Blackberry
                                    <span class="middle">x 02</span>
                                    <span class="last">$720.00</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Fresh Tomatoes
                                    <span class="middle">x 02</span>
                                    <span class="last">$720.00</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Fresh Brocoli
                                    <span class="middle">x 02</span>
                                    <span class="last">$720.00</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="list list_2">
                            <li>
                                <a href="#">Subtotal <span>$2160.00</span></a>
                            </li>
                            <li>
                                <a href="#">Shipping
                                    <span>Flat rate: $50.00</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Total<span>$2210.00</span>
                                </a>
                            </li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector" />
                                <label for="f-option5">Check payments</label>
                                <div class="check"></div>
                            </div>
                            <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="selector" />
                                <label for="f-option6">Paypal </label>
                                <img src="assets/img/gallery/card.html" alt="" />
                                <div class="check"></div>
                            </div>
                            <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                        </div>
                        <div class="creat_account checkout-cap">
                            <input type="checkbox" id="f-option8" name="selector" />
                            <label for="f-option8">I’ve read and accept the  <a href="#">terms & conditions*</a> </label>
                        </div>
                        <a class="btn w-100" href="#">Proceed to Paypal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Checkout Area -->
@endsection

@push('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // $('#district').select2({
            //     placeholder: "Select a district",
            //     allowClear: true
            // });
        });
    </script>
@endpush
