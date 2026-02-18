@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Candidate Dashboard</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Candidate Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Hero area End -->
<!-- Customer Dashboard  -->



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

            <div class="col-md-12 col-12 mt-1 mb-1 pt-4 pr-4 pl-4">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="profile-wrapper">
                                    <img class="align-self-start mr-3 profile-pic" id="profilePreview" src="https://takemeon.websl.lk/uploads/post/profile-pic/Group 7420260213110207.png" alt="{{ Auth::user()->name }}"/>

                                   <div class="profile-overlay">
                                        Click to Change
                                    </div>
                                </div> 
                                <input type="file" id="profileInput" accept="image/*" style="display:none;">   
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="row">
                            <div class="col-md-12 col-12 mt-1 mb-1 pt-4 pr-4 pl-4">
                                <h5 class="candidate_name mb-0">{{ Auth::user()->name }}</h5>
                            </div>

                            <div class="col-md-12 col-12 mt-1 mb-1 pr-4 pl-4">
                                <p class="profile-progress-txt mb-0">Profile completeness</p>
                            </div>

                            <div class="col-md-12 col-12 mb-2 pr-4 pl-4">
                                <div class="progress mt-0">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                </div>
                            </div>                            
                        </div>                        
                    </div>
                </div>
            </div>           

            <div class="col-xl-12 col-md-12">
                <div class="candidate_info mb-35 pl-5 pr-5 pb-5 pt-3">
                    <div class="d-flex align-items-start">

                        <!-- LEFT SIDE NAV -->
                        <div class="nav flex-column nav-pills mr-3 w-25" 
                            id="v-pills-tab" 
                            role="tablist" 
                            aria-orientation="vertical">

                            <a class="nav-link rounded-0 active"
                            id="personal-tab"
                            data-toggle="pill"
                            href="#personal"
                            role="tab">
                            Personal Details
                            </a>

                            <a class="nav-link rounded-0"
                            id="expecting-tab"
                            data-toggle="pill"
                            href="#expecting"
                            role="tab">
                            Expecting Area
                            </a>

                            <a class="nav-link rounded-0"
                            id="education-tab"
                            data-toggle="pill"
                            href="#education"
                            role="tab">
                            Education
                            </a>

                            <a class="nav-link rounded-0"
                            id="school-tab"
                            data-toggle="pill"
                            href="#school"
                            role="tab">
                            School Level
                            </a>

                            <a class="nav-link rounded-0"
                            id="professional-tab"
                            data-toggle="pill"
                            href="#professional"
                            role="tab">
                            Professional Details
                            </a>

                            <a class="nav-link rounded-0"
                            id="employment-tab"
                            data-toggle="pill"
                            href="#employment"
                            role="tab">
                            Past Employments
                            </a>

                        </div>

                        <!-- RIGHT SIDE CONTENT -->
                        <div class="tab-content w-75" id="v-pills-tabContent">

                            <!-- PERSONAL DETAILS -->
                            <div class="tab-pane fade show active"
                                id="personal"
                                role="tabpanel">

                                <h4 class="mb-3">Personal Details</h4>
                                <p>Add your personal information here.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <form action="{{ route('frontend.userprofile.update',Auth::user()->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Full name</label>
                                                <input type="text" placeholder="Enter full name" value="{{ old('full_name',Auth::user()->name) }}" name="full_name" class="form-control custom-input">
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" placeholder="Enter email address" value="{{ old('email',Auth::user()->email) }}" name="email" class="form-control custom-input">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="number" placeholder="Enter Phone Number" value="{{ old('phone_number',Auth::user()->phone) }}" name="phone_number" class="form-control custom-input">
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" placeholder="Enter Username" value="{{ old('username',Auth::user()->username) }}" name="username" class="form-control custom-input">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" placeholder="Enter New Password" name="password" class="form-control custom-input">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control custom-input">
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-login btn-block mb-3">Update Profile</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- EXPECTING AREA -->
                            <div class="tab-pane fade"
                                id="expecting"
                                role="tabpanel">

                                <h4 class="mb-3">Expecting Area</h4>
                                <p>Add your preferred job locations and salary expectations.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        aaaaaaaa
                                    </div>
                                </div>

                            </div>


                            <!-- EDUCATION -->
                            <div class="tab-pane fade"
                                id="education"
                                role="tabpanel">

                                <h4 class="mb-3">Education</h4>
                                <p>Add university or diploma information.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        aaaaaaaa
                                    </div>
                                </div>

                            </div>


                            <!-- SCHOOL LEVEL -->
                            <div class="tab-pane fade"
                                id="school"
                                role="tabpanel">

                                <h4 class="mb-3">School Level</h4>
                                <p>Add O/L, A/L or other school details.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        aaaaaaaa
                                    </div>
                                </div>

                            </div>


                            <!-- PROFESSIONAL DETAILS -->
                            <div class="tab-pane fade"
                                id="professional"
                                role="tabpanel">

                                <h4 class="mb-3">Professional Details</h4>
                                <p>Add skills, certifications and experience summary.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        aaaaaaaa
                                    </div>
                                </div>

                            </div>


                            <!-- PAST EMPLOYMENTS -->
                            <div class="tab-pane fade"
                                id="employment"
                                role="tabpanel">

                                <h4 class="mb-3">Past Employments</h4>
                                <p>Add previous job history here.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        aaaaaaaa
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
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
</section>    

<!--/ Customer Dashboard  -->

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        .profile-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            img {
                width: 235px;
                height: auto;
                /* border-radius: 50%; */
                object-fit: cover;
                transition: 0.3s;
            }
            .profile-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 235px;
                height: 100%;
                /* border-radius: 50%; */
                background: rgba(0,0,0,0.6);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: 0.3s;
                font-size: 14px;
                font-weight: 600;
            }
            &:hover{
                .profile-overlay {
                    opacity: 1;
                }
            }
        }

        .candidate_info{
            .nav{
                .nav-link{
                    color: #635c5c;
                }
                .nav-link.active{
                    color: #ffffff;
                    background-color: #8f50a2;
                }
            }
        }

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
            $('.profile-wrapper').click(function () {
                $('#profileInput').click();
            });

             $('#profileInput').change(function () {

                let file = this.files[0];
                if (!file) return;

                let formData = new FormData();
                formData.append('profile_img', file);
                formData.append('_token', '{{ csrf_token() }}');

                // Loading alert
                Swal.fire({
                    title: 'Uploading...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: "{{ route('frontend.userprofile.update', Auth::user()->id) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated!',
                            text: 'Your profile image has been updated.',
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Instant preview
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            $('#profilePreview').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);

                    },
                    error: function (xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed!',
                            position: "bottom-end",
                            text: 'Please try again.'
                        });

                    }
                });

            });
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
