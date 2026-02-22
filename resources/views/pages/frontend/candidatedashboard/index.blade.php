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
                                                <label>DOB</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        name="dob"
                                                        id="dob"
                                                        class="form-control custom-input"
                                                        value="{{ old('dob', Auth::user()->dob) }}"
                                                        placeholder="Select DOB"
                                                        autocomplete="off">

                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <small class="text-danger error-text dob_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>NIC</label>
                                                <input type="text" placeholder="Enter NIC" value="{{ old('nic',Auth::user()->nic) }}" id="nic"  name="nic" class="form-control custom-input">
                                                <small class="text-danger error-text nic_error"></small>
                                            </div>
                                            <div class="form-group col-12 col-md-12">
                                                <label>Address</label>
                                                <input type="text" placeholder="Enter Address" value="{{ old('address',Auth::user()->address) }}" name="address" class="form-control custom-input">
                                                <small class="text-danger error-text address_error"></small>
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
                                                <form action="{{ route('frontend.userexpectingdetails.update',Auth::user()->id) }}" method="POST" id="expectingUpdateForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Job Industry</label>
                                                            <input type="text" placeholder="Enter Job Industry" value="{{ old('job_industry',optional($user->expectingArea)->job_industry) }}" name="job_industry" class="form-control custom-input">
                                                            <small class="text-danger error-text job_industry_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Job Type</label>
                                                            <input type="text" placeholder="Enter Job Type" value="{{ old('job_type',optional($user->expectingArea)->job_type) }}" name="job_type" class="form-control custom-input">
                                                            <small class="text-danger error-text job_type_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Job Role</label>
                                                            <input type="text" placeholder="Enter Job Role" value="{{ old('job_role',optional($user->expectingArea)->job_role) }}" name="job_role" class="form-control custom-input">
                                                            <small class="text-danger error-text job_role_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Designation</label>
                                                            <input type="text" placeholder="Enter designation" value="{{ old('designation',optional($user->expectingArea)->designation) }}" name="designation" class="form-control custom-input">
                                                            <small class="text-danger error-text username_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-12 text-right mt-3">
                                                            <button type="submit" class="btn btn-login btn-block mb-3" id="updateExpectingBtn">Update Now</button>
                                                        </div>
                                                    </form>
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
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <form action="{{ route('frontend.usereducation.update',Auth::user()->id) }}" method="POST" id="educationUpdateForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Highest Education Level</label>
                                                            <input type="text" placeholder="Enter Job Industry" value="{{ old('highest_education_level',optional($user->UserEducation)->highest_education_level) }}" name="highest_education_level" class="form-control custom-input">
                                                            <small class="text-danger error-text highest_education_level_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Educational Specialization</label>
                                                            <input type="text" placeholder="Enter Job Type" value="{{ old('educational_specialization',optional($user->UserEducation)->educational_specialization) }}" name="educational_specialization" class="form-control custom-input">
                                                            <small class="text-danger error-text educational_specialization_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Institute / University</label>
                                                            <input type="text" placeholder="Enter Job Role" value="{{ old('institute_university',optional($user->UserEducation)->institute_university) }}" name="institute_university" class="form-control custom-input">
                                                            <small class="text-danger error-text institute_university_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-12 text-right mt-3">
                                                            <button type="submit" class="btn btn-login btn-block mb-3" id="updateEducationBtn">Update Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <form action="{{ route('frontend.userschoollevel.update',Auth::user()->id) }}" method="POST" id="schoolUpdateForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>O/L School</label>
                                                            <input type="text" placeholder="Enter O/L School" value="{{ old('ol_school',optional($user->schoolLevel)->ol_school) }}" name="ol_school" class="form-control custom-input">
                                                            <small class="text-danger error-text ol_school_error"></small>
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>O/L Year</label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    name="ol_year"
                                                                    id="ol_year"
                                                                    class="form-control custom-input"
                                                                    value="{{ old('ol_year', optional($user->schoolLevel)->ol_year) }}"
                                                                    placeholder="Select O/L Year"
                                                                    autocomplete="off">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <small class="text-danger error-text ol_year_error"></small>
                                                        </div>

                                                        <div class="form-group col-12 col-md-6">
                                                            <label>A/L School</label>
                                                            <input type="text" placeholder="Enter A/L School" value="{{ old('al_school',optional($user->schoolLevel)->al_school) }}" name="al_school" class="form-control custom-input">
                                                            <small class="text-danger error-text al_school_error"></small>
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>A/L Year</label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    name="al_year"
                                                                    id="al_year"
                                                                    class="form-control custom-input"
                                                                    value="{{ old('al_year', optional($user->schoolLevel)->al_year) }}"
                                                                    placeholder="Select A/L Year"
                                                                    autocomplete="off">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <small class="text-danger error-text al_year_error"></small>
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-12 text-right mt-3">
                                                            <button type="submit" class="btn btn-login btn-block mb-3" id="updateSchoolBtn">Update Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <form action="{{ route('frontend.userprofessional.update',Auth::user()->id) }}" method="POST" id="professionalUpdateForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Total Years Experience</label>
                                                            <input type="number" placeholder="Enter Total Years Experience" value="{{ old('total_years_experience',optional($user->professionalDetail)->total_years_experience) }}" name="total_years_experience" class="form-control custom-input">
                                                            <small class="text-danger error-text total_years_experience_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Skills Summary</label>
                                                            <input type="text" placeholder="Enter Skills Summary" value="{{ old('skills_summary',optional($user->professionalDetail)->skills_summary) }}" name="skills_summary" class="form-control custom-input">
                                                            <small class="text-danger error-text skills_summary_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-12">
                                                            <label>About yourself</label>
                                                            <textarea rows="4" placeholder="Enter About yourself"  name="about_yourself" class="form-control custom-input">{{ old('about_yourself',optional($user->professionalDetail)->about_yourself) }}</textarea>
                                                            <small class="text-danger error-text about_yourself_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Current Employer</label>
                                                            <input type="text" placeholder="Enter Current Employer" value="{{ old('current_employer',optional($user->professionalDetail)->current_employer) }}" name="current_employer" class="form-control custom-input">
                                                            <small class="text-danger error-text current_employer_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Current Industry</label>
                                                            <input type="text" placeholder="Enter Current Industry" value="{{ old('current_industry',optional($user->professionalDetail)->current_industry) }}" name="current_industry" class="form-control custom-input">
                                                            <small class="text-danger error-text current_industry_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Current Business Function</label>
                                                            <input type="text" placeholder="Enter Current Business Function" value="{{ old('current_business_function',optional($user->professionalDetail)->current_business_function) }}" name="current_business_function" class="form-control custom-input">
                                                            <small class="text-danger error-text current_business_function_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Role / Designation</label>
                                                            <input type="text" placeholder="Enter Designation" value="{{ old('designation',optional($user->professionalDetail)->designation) }}" name="designation" class="form-control custom-input">
                                                            <small class="text-danger error-text designation_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Started in</label>

                                                            <div class="input-group">
                                                                <input type="text"
                                                                    name="started_in"
                                                                    id="started_in"
                                                                    class="form-control custom-input"
                                                                    value="{{ old('started_in', optional($user->professionalDetail)->started_in) }}"
                                                                    placeholder="Select start date"
                                                                    autocomplete="off">

                                                                <div class="input-group-append">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <small class="text-danger error-text started_in_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Notice period (in days)</label>
                                                            <input type="text" placeholder="Enter Notice period (in days)" value="{{ old('notice_period_days',optional($user->professionalDetail)->notice_period_days) }}" name="notice_period_days" class="form-control custom-input">
                                                            <small class="text-danger error-text notice_period_days_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-12">
                                                            <label>About the current role</label>
                                                            <textarea rows="4" placeholder="Enter About the current role"  name="about_current_role" class="form-control custom-input">{{ old('about_current_role',optional($user->professionalDetail)->about_current_role) }}</textarea>
                                                            <small class="text-danger error-text about_current_role_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Current salary (per month) (Rs)</label>
                                                            <input type="number" placeholder="Enter Current salary (per month) (Rs)" value="{{ old('current_salary',optional($user->professionalDetail)->current_salary) }}" name="current_salary" class="form-control custom-input">
                                                            <small class="text-danger error-text current_salary_error"></small>
                                                        </div>
                                                        <div class="form-group col-12 col-md-12 text-right mt-3">
                                                            <button type="submit" class="btn btn-login btn-block mb-3" id="updateProfessionalBtn">Update Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- PAST EMPLOYMENTS -->
                            <div class="tab-pane fade"
                                id="employment"
                                role="tabpanel">
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h4 class="mb-3">Past Employments</h4>
                                        <p>Add previous job history here.</p>
                                    </div>
                                    <div class="col-12 col-md-6 align-content-center text-center">
                                        <button type="button" class="add_past_employment cursor-pointer" data-id="{{ Auth::user()->id }}"><i class="fa fa-plus-circle"></i> Add past employment</button>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-md-12" id="fetch_past_employment">
                                        
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
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 35px;
        }
        .add_past_employment{
            color:#421c4e;
            border: none;
            background: #fff;
            &:hover{
                color:#8f50a2;
                border: none;
                background: #fff;
            }
        }
        .past_emp_details{
            .past_emp_row{
                padding:8px;
                box-shadow:0px 3px 10px 2px #ddd;
                &:hover{
                   box-shadow:0px 3px 15px 5px #ddd; 
                }
                .head-text-past-emp {
                    color: #707676;
                }
                .sub-text-past-emp {
                    color: #afb7ad;
                }
                .right-arrow i {
                    color: #afb7ad;
                    font-size: 35px;
                }
            }
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
                        $('input[name="address"]').val(response.data.address);
                        $('input[name="dob"]').val(response.data.dob);
                        $('input[name="nic"]').val(response.data.nic);
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

            $('#dob').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: new Date(), // prevent future dates
                todayHighlight: true
            });
            // Click icon to open
            $('#dob').siblings('.input-group-append').click(function () {
                $('#dob').datepicker('show');
            });
        

            $('#updateExpectingBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#expectingUpdateForm');
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
                        $('#updateExpectingBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updateExpectingBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="job_industry"]').val(response.data.job_industry);
                        $('input[name="job_type"]').val(response.data.job_type);
                        $('input[name="job_role"]').val(response.data.job_role);
                        $('input[name="designation"]').val(response.data.designation);

                    },
                    error: function (xhr) {

                        $('#updateExpectingBtn').prop('disabled', false);

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

            $('#updateEducationBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#educationUpdateForm');
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
                        $('#updateEducationBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updateEducationBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="highest_education_level"]').val(response.data.highest_education_level);
                        $('input[name="educational_specialization"]').val(response.data.educational_specialization);
                        $('input[name="institute_university"]').val(response.data.institute_university);

                    },
                    error: function (xhr) {

                        $('#updateEducationBtn').prop('disabled', false);

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

            $('#updateSchoolBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#schoolUpdateForm');
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
                        $('#updateSchoolBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updateSchoolBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="al_school"]').val(response.data.al_school);
                        $('input[name="educational_specialization"]').val(response.data.al_year);
                        $('input[name="ol_school"]').val(response.data.ol_school);
                        $('input[name="ol_year"]').val(response.data.ol_year);

                    },
                    error: function (xhr) {

                        $('#updateSchoolBtn').prop('disabled', false);

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

            $('#ol_year').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
                endDate: new Date() // prevent future years
            });

            // Click icon to open
            $('#ol_year').siblings('.input-group-append').click(function () {
                $('#ol_year').datepicker('show');
            });

            // Click icon to open
            $('#al_year').siblings('.input-group-append').click(function () {
                $('#al_year').datepicker('show');
            });

            $('#al_year').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
                endDate: new Date() // prevent future years
            });

            // Click icon to open
            $('#al_year').siblings('.input-group-append').click(function () {
                $('#al_year').datepicker('show');
            });

            $('#updateProfessionalBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#professionalUpdateForm');
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
                        $('#updateProfessionalBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updateProfessionalBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="total_years_experience"]').val(response.data.total_years_experience);
                        $('input[name="skills_summary"]').val(response.data.skills_summary);
                        $('textarea[name="about_yourself"]').val(response.data.about_yourself);
                        $('input[name="current_employer"]').val(response.data.current_employer);
                        $('input[name="current_industry"]').val(response.data.current_industry);
                        $('input[name="current_business_function"]').val(response.data.current_business_function);
                        $('input[name="designation"]').val(response.data.designation);
                        $('input[name="started_in"]').val(response.data.started_in);
                        $('input[name="notice_period_days"]').val(response.data.notice_period_days);
                        $('textarea[name="about_current_role"]').val(response.data.about_current_role);
                        $('input[name="current_salary"]').val(response.data.current_salary);

                    },
                    error: function (xhr) {

                        $('#updateProfessionalBtn').prop('disabled', false);

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

            $('#started_in').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: new Date(), // prevent future dates
                todayHighlight: true
            });

            // Click icon to open
            $('#started_in').siblings('.input-group-append').click(function () {
                $('#started_in').datepicker('show');
            });


            $('#updatePastEmpBtn').on('click', function (e) {
                e.preventDefault();

                let form = $('#pastEmpUpdateForm');
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
                        $('#updatePastEmpBtn').prop('disabled', true);
                    },
                    success: function (response) {

                        $('#updatePastEmpBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            position: "bottom-end",
                            showConfirmButton: false
                        });

                        // Update values dynamically
                        $('input[name="total_years_experience"]').val(response.data.total_years_experience);
                        $('input[name="skills_summary"]').val(response.data.skills_summary);
                        $('textarea[name="about_yourself"]').val(response.data.about_yourself);
                        $('input[name="current_employer"]').val(response.data.current_employer);
                        $('input[name="current_industry"]').val(response.data.current_industry);
                        $('input[name="current_business_function"]').val(response.data.current_business_function);
                        $('input[name="designation"]').val(response.data.designation);
                        $('input[name="started_in"]').val(response.data.started_in);
                        $('input[name="notice_period_days"]').val(response.data.notice_period_days);
                        $('textarea[name="about_current_role"]').val(response.data.about_current_role);
                        $('input[name="current_salary"]').val(response.data.current_salary);

                    },
                    error: function (xhr) {

                        $('#updatePastEmpBtn').prop('disabled', false);

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

            $('#started_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: new Date(), // prevent future dates
                todayHighlight: true
            });

            // Click icon to open
            $('#started_date').siblings('.input-group-append').click(function () {
                $('#started_date').datepicker('show');
            });

            $('#resigned_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: new Date(), // prevent future dates
                todayHighlight: true
            });

             $(document).on('click', '#employment-tab', function () {
                fetchPastEmployement();
            });
            

            fetchPastEmployement();

            function fetchPastEmployement(user_id = '{{ Auth::id() }}') {

                $.ajax({
                    url: '{{ route("frontend.fetchpastemployement", Auth::id()) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {

                        if (response.status) {

                            let html = '';

                            if (response.data.length === 0) {
                                html = '<p class="text-muted">No past employment found</p>';
                            } else {

                                response.data.forEach(function(item) {

                                    let startDate = formatDate(item.start_date);
                                    let endDate   = item.end_date ? formatDate(item.end_date) : 'Present';

                                    html += `
                                    <div class="past_emp_details cursor-pointer" data-id="${item.id}" data-userid="${item.user_id}">
                                        <div class="row mb-2 past_emp_row">
                                            <div class="col-md-10 col-6">
                                                <div class="form-group row">
                                                    <span class="col-md-12 mb-0 head-text-past-emp">
                                                        <b>${item.company_name}</b>
                                                    </span>
                                                    <div class="col-md-6">
                                                        <span class="add-emp-history sub-text-past-emp">
                                                            ${startDate} to ${endDate}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 right-arrow align-content-center">
                                                <i class="fa fa-angle-right"></i> 
                                            </div>
                                        </div>
                                    </div>`;
                                });

                            }

                            $('#fetch_past_employment').html(html);

                        }

                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON?.message || 'Something went wrong!');
                    }
                });

            }

            function formatDate(dateString) {
                if (!dateString) return '';

                const date = new Date(dateString);

                const day = date.getDate().toString().padStart(2, '0');
                const month = date.toLocaleString('en-US', { month: 'short' });
                const year = date.getFullYear();

                return `${day}-${month}, ${year}`;
            }

            // Click icon to open
            $('#resigned_date').siblings('.input-group-append').click(function () {
                $('#resigned_date').datepicker('show');
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
        
            $(document).on('click', '.past_emp_details', function () {   
                var user_id = $(this).data('userid'); 
                var emp_id = $(this).data('id');
                $.ajax({
                    url: '{{ route("frontend.detailspastemployement", Auth::id()) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        emp_id: emp_id,
                        user_id: user_id
                    },
                    success: function (response) {
                        if (response.status) {
                            let html = '';
                            if (response.data.length === 0) {
                                html = '<p class="text-muted">No past employment Details found</p>';
                            } else {

                                    let data = response.data;
                                    let startDate = formatDate(data.start_date);
                                    let endDate   = data.end_date ? formatDate(data.end_date) : 'Present';

                                    html += `
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <b>${data.company_name ?? ''}</b>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    ${startDate} to ${endDate}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <b>Industry</b>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    ${data.industry ?? '-'}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <b>Business Function</b>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    ${data.employee_category	 ?? ''}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <b>Role / Designation</b>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    ${data.	role ?? ''}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <b>About the role</b>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    ${data.about_role ?? ''}
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;

                                    FormModelDetails('Past Employment Details', html, 'Cancel', '', 0, '', 'GET');
                            
                            }

                        }

                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON?.message || 'Something went wrong!');
                    }
                }); 
            });
            $(document).on('click','.add_past_employment',function(){
                var user_id = $(this).data('id'); 
                console.log('USER ID : '+user_id);    
                $.ajax({
                    url: '{{ route("frontend.checkpastemployement", Auth::id()) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: user_id
                    },
                    success: function (response) {
                        console.log('Response : '+response.status); 
                        if (response.status) {
                            let htmladdemform = '';
                            if (response.data.length === 0) {
                                htmladdemform = '<p class="text-muted">No past employment Details found</p>';
                            } else {
                                    let data = response.data;
                                    htmladdemform = data;
                            }
                            FormModelDetails('Add Past Employment', htmladdemform, 'Cancel', 'Add', 0, '{{ route('admin.logout') }}', 'POST');
                            $('#formModel').off('shown.bs.modal').on('shown.bs.modal', function () {

                                // SELECT2
                                $('.select2').select2({
                                    //dropdownParent: $('#formModel'),
                                    width: '100%'
                                });

                                // START DATE PICKER
                                $('#add_start_date').datepicker({
                                    format: 'yyyy-mm-dd',
                                    autoclose: true,
                                    endDate: new Date(),
                                    todayHighlight: true
                                });

                                // END DATE PICKER
                                $('#add_end_date').datepicker({
                                    format: 'yyyy-mm-dd',
                                    autoclose: true,
                                    endDate: new Date(),
                                    todayHighlight: true
                                });

                                // Click icon to open
                                $('#add_start_date').siblings('.input-group-append').click(function () {
                                    $('#add_start_date').datepicker('show');
                                });

                                $('#add_end_date').siblings('.input-group-append').click(function () {
                                    $('#add_end_date').datepicker('show');
                                });

                            });

                        }

                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON?.message || 'Something went wrong!');
                    }
                });
            });   


            $('#add_start_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                endDate: new Date(), // prevent future dates
                todayHighlight: true
            });

            // Click icon to open
            $('#add_start_date').siblings('.input-group-append').click(function () {
                $('#add_start_date').datepicker('show');
            });
            
                      
            

            function formatDate(dateString) {
                if (!dateString) return '';

                const date = new Date(dateString);

                const day = date.getDate().toString().padStart(2, '0');
                const month = date.toLocaleString('en-US', { month: 'short' });
                const year = date.getFullYear();

                return `${day}-${month}, ${year}`;
            }

            
            //FormModelDetails('Title', 'This is a test', 'cancel', 'ok', 0, null,'POST');
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
        

    </script>

@endpush
