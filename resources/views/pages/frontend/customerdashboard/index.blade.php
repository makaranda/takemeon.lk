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
                            <h2>Customer Dashboard</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Customer Dashboard</a></li>
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
<!-- Customer Dashboard  -->
<div class="about_area pb-5 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                {{-- <div class="about_info pl-0">
                    <h3>Customer Dashboard</h3>

                </div> --}}
            </div>
            <div class="col-12 col-md-12">
                <div class="about_sub_description">
                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger d-block align-items-center" role="alert">
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
                        <div class="alert alert-success d-block align-items-center" role="alert">
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
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="about_info mb-35">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3 w-25" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link genric-btn rounded-0 primary active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</button>
                            <button class="nav-link genric-btn default" id="v-pills-pending-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pending" type="button" role="tab" aria-controls="v-pills-pending" aria-selected="false">Pending Orders</button>
                            <button class="nav-link genric-btn default" id="v-pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cancel" type="button" role="tab" aria-controls="v-pills-cancel" aria-selected="false">Cancel Orders</button>
                            <button class="nav-link genric-btn default" id="v-pills-complete-tab" data-bs-toggle="pill" data-bs-target="#v-pills-complete" type="button" role="tab" aria-controls="v-pills-complete" aria-selected="false">Complete Orders</button>
                        </div>

                        <div class="tab-content w-100 w-75" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                <div class="register-form-area w-100 p-0">
                                    <div class="register-form text-center">
                                        <div class="input-box pb-0 pt-0">
                                            <form action="{{ route('frontend.userprofile.update',Auth::user()->id) }}" method="POST">
                                            @csrf
                                            <div class="single-input-fields">
                                                <label>Full name</label>
                                                <input type="text" placeholder="Enter full name" value="{{ old('full_name',Auth::user()->name) }}" name="full_name">
                                            </div>
                                            <div class="single-input-fields">
                                                <label>Email Address</label>
                                                <input type="email" placeholder="Enter email address" value="{{ old('email',Auth::user()->email) }}" name="email">
                                            </div>
                                            <div class="single-input-fields">
                                                <label>Phone</label>
                                                <input type="number" placeholder="Enter Phone Number" value="{{ old('phone_number',Auth::user()->phone) }}" name="phone_number">
                                            </div>
                                            <div class="single-input-fields">
                                                <label>Username</label>
                                                <input type="text" placeholder="Enter Username" value="{{ old('username',Auth::user()->username) }}" name="username">
                                            </div>
                                            <div class="single-input-fields">
                                                <label>New Password</label>
                                                <input type="password" placeholder="Enter New Password" name="password">
                                            </div>
                                            <div class="single-input-fields">
                                                <label>Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" name="confirm_password">
                                            </div>
                                            <div class="single-input-fields text-right">
                                                <button type="submit" class="submit-btn3">Update Profile</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-pending" role="tabpanel" aria-labelledby="v-pills-pending-tab" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="pendingTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pending_orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ ucfirst($order->status) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5">No pending orders.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="v-pills-cancel" role="tabpanel" aria-labelledby="v-pills-cancel-tab" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="cancelTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cancel_orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ ucfirst($order->status) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5">No cancelled orders.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="v-pills-complete" role="tabpanel" aria-labelledby="v-pills-complete-tab" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="completeTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($complete_orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->qty }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ ucfirst($order->status) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5">No completed orders.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!--/ Customer Dashboard  -->

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Init cancelTable and completeTable if present and visible
            if ($('#cancelTable').length && $('#cancelTable').is(':visible')) {
                $('#cancelTable').DataTable();
            }

            if ($('#completeTable').length && $('#completeTable').is(':visible')) {
                $('#completeTable').DataTable();
            }

            // Handle tab-based table initialization
            $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
                const targetId = e.target.id;

                if (targetId === 'v-pills-pending-tab') {
                    if (!$.fn.dataTable.isDataTable('#pendingTable')) {
                        $('#pendingTable').DataTable();
                    }
                }

                if (targetId === 'v-pills-cancel-tab') {
                    if (!$.fn.dataTable.isDataTable('#cancelTable')) {
                        $('#cancelTable').DataTable();
                    }
                }

                if (targetId === 'v-pills-complete-tab') {
                    if (!$.fn.dataTable.isDataTable('#completeTable')) {
                        $('#completeTable').DataTable();
                    }
                }
            });
        });

    </script>
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

            $('#v-pills-tab button').click(function () {
                $('#v-pills-tab button').removeClass('primary default');
                $(this).addClass('genric-btn primary rounded-0');
                //$(this).addClass('active');
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
