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
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="First name" readonly/>
                            <span class="placeholder" data-placeholder="First name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Phone number" readonly/>
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
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <div id="orderSummary">
                            <h2>Your Order</h2>
                            <ul class="list" id="checkoutItemsList">
                                <!-- items will load here -->
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span id="checkoutSubtotal"></span></a></li>
                                <li><a href="#">Shipping <span id="checkoutShipping"></span></a></li>
                                <li><a href="#">Total <span id="checkoutTotal"></span></a></li>
                            </ul>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="payment_method" value="cod" checked />
                                <label for="f-option5">Cash on Delivery</label>
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Name, Address, Phone, Town, District and Postcode.</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="payment_method" value="stripe" />
                                <label for="f-option6">Stripe</label>
                                <img src="assets/img/gallery/card.html" alt="" />
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Name, Address, Phone, Town, District and Postcode.</p>
                        </div>
                        <div class="creat_account checkout-cap">
                            <input type="checkbox" id="f-option8" name="terms" />
                            <label for="f-option8">I’ve read and accept the <a href="{{ route('frontend.termsandconditions') }}">terms & conditions*</a></label>
                        </div>
                        <button type="button" class="btn w-100" id="submitCheckout">Proceed to Cash on Delivery</button>
                    </div>
                </div>
                </form>
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
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function () {
            // $('#district').select2({
            //     placeholder: "Select a district",
            //     allowClear: true
            // });

            function updateCheckoutButton() {
                let method = $('input[name="payment_method"]:checked').val();
                let buttonText = 'Proceed to ';
                if (method === 'cod') {
                    buttonText += 'Cash on Delivery';
                } else if (method === 'stripe') {
                    buttonText += 'Stripe';
                } else {
                    buttonText += 'Checkout';
                }
                $('#submitCheckout').text(buttonText);
            }

            // On page load
            updateCheckoutButton();

            // On change
            $('input[name="payment_method"]').on('change', function () {
                updateCheckoutButton();
            });

            $('#district').on('change', function () {
                 let districtId = $(this).val();
                 loadCheckoutData()
            });

            function loadCheckoutData() {
                $.ajax({
                    url: "{{ route('frontend.checkout.data') }}",
                    type: "GET",
                    data: {'district_id': $('#district').val()},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        let itemsHtml = `<li>
                                <a href="#">Product<span>Total</span>
                                </a>
                            </li>`;
                        $.each(response.cart_items, function (i, item) {
                            itemsHtml += `
                                <li>
                                    <a href="#">${item.title}
                                        <span class="middle">x ${item.quantity}</span>
                                        <span class="last">Rs. ${item.total_price}</span>
                                    </a>
                                </li>`;
                        });

                        $('#checkoutItemsList').html(itemsHtml);
                        $('#checkoutSubtotal').text('Rs. ' + response.subtotal);
                        $('#checkoutShipping').text('Rs. ' + response.shipping);
                        $('#checkoutTotal').text('Rs. ' + response.total);
                    },
                    error: function () {
                        $('#checkoutItemsList').html('<li>Error loading cart.</li>');
                    }
                });
            }

            // Load on page ready
            loadCheckoutData();
        });
    </script>
    <script>
        $(document).ready(function () {
            // Select2 Init
            // $('#district').select2();

            // Set up stripe
            const stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");

            // Dynamic totals
            function updateTotals(districtId) {
                let updateUrl = '{{ route("frontend.checkout.shippingcharge", ":district") }}';
                updateUrl = updateUrl.replace(':district', districtId);
                $.get(`${updateUrl}`, function (data) {
                    $('#checkoutSubtotal').text('Rs. ' + data.subtotal);
                    $('#checkoutShipping').text('Rs. ' + data.shipping);
                    $('#checkoutTotal').text('Rs. ' + data.total);
                });
            }

            // On district change
            $('#district').on('change', function () {
                updateTotals($(this).val());
            });
            updateTotals($('#district').val());

            // Dynamic validation
            $('#different_address').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#other_address').prop('required', true);
                    $('#address').prop('required', false);
                } else {
                    $('#other_address').prop('required', false);
                    $('#address').prop('required', true);
                }
            });

            // Dynamic button text
            $('input[name="payment_method"]').on('change', function () {
                const method = $(this).val();
                const label = method === 'stripe' ? 'Proceed to Stripe' : 'Proceed to Cash on Delivery';
                $('#submitCheckout').text(label);
            });

            // Checkout submit
            $('#submitCheckout').on('click', function () {
                const formData = {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    city: $('#city').val(),
                    district: $('#district').val(),
                    zip: $('#zip').val(),
                    other_address: $('#other_address').val(),
                    different_address: $('#different_address').is(':checked'),
                    payment_method: $('input[name="payment_method"]:checked').val(),
                    terms: $('#f-option8').is(':checked')
                };

                // Validate client-side
                if (!formData.terms) {
                    //alert('Please accept terms & conditions');
                    Swal.fire('Alert', 'Please accept terms & conditions', 'error');
                    return;
                }

                // Stripe or COD handling
                if (formData.payment_method === 'stripe') {
                    $.post("{{ route('frontend.stripe.intent') }}", formData, function (res) {
                        stripe.confirmCardPayment(res.client_secret, {
                            payment_method: {
                                card: {
                                    number: '4242424242424242',
                                    exp_month: 12,
                                    exp_year: 2034,
                                    cvc: '567'
                                },
                                billing_details: {
                                    name: formData.name,
                                    email: formData.email
                                }
                            }
                        }).then(function (result) {
                            if (result.error) {
                                //alert('Payment failed: ' + result.error.message);
                                Swal.fire('Payment failed', result.error.message, 'error');
                            } else {
                                // Save order
                                formData.payment_intent = result.paymentIntent.id;
                                $.post("{{ route('frontend.checkout.store') }}", formData, function (orderRes) {
                                    Swal.fire('Success', 'Thank You, We will process your order soon', 'success');
                                    // window.location.href = '/thank-you';
                                });
                            }
                        });
                    });
                } else {

                    $.ajax({
                        url: '{{ route("frontend.checkout.store") }}',
                        method: 'GET',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire('Success', 'Thank You, We will process your order soon.', 'success');
                            // window.location.href = '/thank-you';
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            console.error('Response:', xhr.responseText);
                            //alert('There was an error processing your request.');
                            console.error('Error details:', xhr);
                            console.error('Status:', status);
                            console.error('Response:', xhr.responseText);
                            Swal.fire('Error', 'There was an error processing your request.', 'error');

                        }
                    });
                    // $.post("{{ route('frontend.checkout.store') }}", formData, function (res) {
                    //     Swal.fire('Success', 'Thank You', 'success');
                    //     //window.location.href = '/thank-you';
                    // });
                }
            });
        });
    </script>
@endpush
