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
                            <h2>Cart</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Cart</a></li>
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
<!--================Cart Area =================-->
<!-- Cart Area -->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive" id="cart_details">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($cart) > 0)
                            @php $subTotal = 0; @endphp
                            @foreach ($cart as $productId => $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $subTotal += $itemTotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('public/assets/uploads/products/' . $item['image']) }}" alt="{{ $item['title'] }}" width="80">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $item['title'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rs {{ number_format($item['price'], 2) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <span class="input-number-decrement" data-id="{{ $productId }}"> <i class="ti-minus"></i></span>
                                            <input class="input-number" type="text" value="{{ $item['quantity'] }}" min="1">
                                            <span class="input-number-increment" data-id="{{ $productId }}"> <i class="ti-plus"></i></span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rs {{ number_format($itemTotal, 2) }}</h5>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td>
                                    <a class="btn" href="{{ route('frontend.cart.clear') }}">Clear Cart</a>
                                </td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>Rs {{ number_format($subTotal, 2) }}</h5>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-warning text-center" role="alert">
                                        Your cart is empty.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="checkout_btn_inner float-right">
                    <a class="btn" href="{{ route('frontend.home.products') }}">Continue Shopping</a>
                    @if (count($cart) > 0)
                        <a class="btn checkout_btn" href="{{ route('frontend.checkout') }}">Proceed to checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


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
