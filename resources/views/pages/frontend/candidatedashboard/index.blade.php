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
                    <div class="row d-flex align-items-start">

                        <!-- LEFT SIDE NAV -->
                        <div class="col-12 col-md-3 nav flex-column nav-pills" 
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
                        <div class="col-12 col-md-9 tab-content" id="v-pills-tabContent">

                            <!-- PERSONAL DETAILS -->
                            <div class="tab-pane fade show active"
                                id="personal"
                                role="tabpanel">

                                <h4 class="mb-3">Personal Details</h4>
                                <p>Add your personal information here.</p>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <form action="{{ route('frontend.userprofiledetails.update',Auth::user()->id) }}" method="POST" id="profileUpdateForm">
                                            @csrf
                                            <div class="row">
                                            <div class="form-group col-12 col-md-6">
                                                <label>Full name</label>
                                                <input type="text" placeholder="Enter full name" value="{{ old('full_name',Auth::user()->name) }}" name="full_name" class="form-control custom-input">
                                                <small class="text-danger error-text full_name_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>Email Address</label>
                                                <input type="email" placeholder="Enter email address" value="{{ old('email',Auth::user()->email) }}" name="email" class="form-control custom-input">
                                                <small class="text-danger error-text email_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>Phone</label>
                                                <input type="number" placeholder="Enter Phone Number" value="{{ old('phone_number',Auth::user()->phone) }}" name="phone_number" class="form-control custom-input">
                                                <small class="text-danger error-text phone_number_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>Username</label>
                                                <input type="text" placeholder="Enter Username" value="{{ old('username',Auth::user()->username) }}" name="username" class="form-control custom-input">
                                                <small class="text-danger error-text username_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>New Password</label>
                                                <input type="password" placeholder="Enter New Password" name="password" class="form-control custom-input">
                                                <small class="text-danger error-text password_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control custom-input">
                                                <small class="text-danger error-text confirm_password_error"></small>
                                            </div>
                                            </div>
                                    </div>
                                </div>

                                <h4 class="mb-3">Social Links</h4>
                                <p>Add your Social Links to here.</p>

                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>Facebook Link</label>
                                        <input type="text" placeholder="Enter Facebook Link" value="{{ old('facebook_link',optional($user->socialLinks)->facebook_link) }}" name="facebook_link" class="form-control custom-input">
                                        <small class="text-danger error-text facebook_link_error"></small>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>LinkedIn Link</label>
                                        <input type="text" placeholder="Enter LinkedIn Link" value="{{ old('linkedin_link',optional($user->socialLinks)->linkedin_link) }}" name="linkedin_link" class="form-control custom-input">
                                        <small class="text-danger error-text linkedin_link_error"></small>
                                    </div>
                                    <div class="form-group col-12 col-md-12 text-right mt-3">
                                        <button type="submit" class="btn btn-login btn-block mb-3" id="updateProfileBtn">Update Profile</button>
                                    </div>
                                        </form>
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
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <form action="{{ route('frontend.userexpectingdetails.update',Auth::user()->id) }}" method="POST" id="profileUpdateForm">
                                                    @csrf
                                                    <div class="row">
                                                    <div class="form-group col-12 col-md-6">
                                                        <label>Job Industry</label>
                                                        <input type="text" placeholder="Enter Job Industry" value="{{ old('job_industry',Auth::user()->name) }}" name="job_industry" class="form-control custom-input">
                                                        <small class="text-danger error-text job_industry_error"></small>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6">
                                                        <label>Job Type</label>
                                                        <input type="text" placeholder="Enter Job Type" value="{{ old('job_type',Auth::user()->email) }}" name="job_type" class="form-control custom-input">
                                                        <small class="text-danger error-text job_type_error"></small>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6">
                                                        <label>Job Role</label>
                                                        <input type="text" placeholder="Enter Job Role" value="{{ old('job_role',Auth::user()->phone) }}" name="job_role" class="form-control custom-input">
                                                        <small class="text-danger error-text job_role_error"></small>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6">
                                                        <label>Designation</label>
                                                        <input type="text" placeholder="Enter designation" value="{{ old('designation',Auth::user()->username) }}" name="designation" class="form-control custom-input">
                                                        <small class="text-danger error-text username_error"></small>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
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

        </div>
    </div>
</section>    

<!--/ Customer Dashboard  -->

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        #v-pills-tabContent {
            border-top: 1px solid #ad8bb7;
            padding-top: 14px;
        }
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
                    &:hover{
                        background-color: #d3a7e0;
                    }
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

            $('#updateProfileBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#profileUpdateForm');
                let url = form.attr('action');
                let formData = form.serialize();

                // Clear old errors
                $('.error-text').text('');
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    beforeSend: function () {
                        $('#updateProfileBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updateProfileBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="full_name"]').val(response.data.name);
                        $('input[name="email"]').val(response.data.email);
                        $('input[name="username"]').val(response.data.username);
                        $('input[name="phone_number"]').val(response.data.phone);

                        // Clear password fields
                        $('input[name="password"]').val('');
                        $('input[name="confirm_password"]').val('');
                    },
                    error: function (xhr) {

                        $('#updateProfileBtn').prop('disabled', false);

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value) {

                                $('.' + key + '_error').text(value[0]);
                                $('[name="' + key + '"]').addClass('is-invalid');

                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                position: "bottom-end",
                                text: 'Please fix the highlighted fields.'
                            });
                        }
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
