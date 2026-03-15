@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->

<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Jobs List</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home.jobs') }}">Jobs List</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $job->name }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->
  
<!-- job post company Start -->
<div class="job-post-company pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-between">

            <!-- Left Content -->
            <div class="col-xl-7 col-lg-8">

                <!-- Job Header -->
                <div class="single-job-items mb-50 border-none shadow-none">
                    <div class="job-tittlew-100">
                        <h3>{{ $job->name ?? 'Job Seeker' }}</h3>
                    </div>
                    <div class="job-items">

                        <div class="company-img company-img-details">
                            <img src="{{ asset('public/assets/frontend/candidates/' . ($job->detail?->profile_img ?? 'user_profile.png')) }}">
                        </div>

                        <div class="job-tittle">
                            <h4>{{ $job->expectingArea?->designation ?? 'Job Seeker' }}</h4>

                            <ul>
                                <li>
                                    {{ $job->latestPastEmployment?->company_name ?? 'Company Not Available' }}
                                </li>

                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $job->detail?->city?->name ?? 'Sri Lanka' }}
                                </li>

                                <li>
                                    @php
                                        $salary = $job->expectingArea?->expected_salary;
                                    @endphp

                                    @if($salary)
                                        Rs {{ number_format($salary) }}
                                    @else
                                        Salary Negotiable
                                    @endif
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <!-- Job Header End -->


                <div class="job-post-details">

                    <!-- About Candidate -->
                    <div class="post-details1 mb-50">
                        <div class="small-section-tittle">
                            <h4>About Candidate</h4>
                        </div>

                        <p>
                            {{ $job->professionalDetail?->about_yourself ?? 'No description available' }}
                        </p>
                    </div>


                    <!-- Skills -->
                    <div class="post-details2 mb-50">
                        <div class="small-section-tittle">
                            <h4>Skills</h4>
                        </div>

                        <p>
                            {{ $job->professionalDetail?->skills_summary ?? 'No skills added' }}
                        </p>
                    </div>


                    <!-- Education -->
                    <div class="post-details2 mb-50">

                        <div class="small-section-tittle">
                            <h4>Education</h4>
                        </div>

                        <ul>

                            @if($job->schoolLevel)
                            <li>
                                O/L - {{ $job->schoolLevel->ol_school }} ({{ $job->schoolLevel->ol_year }})
                            </li>

                            <li>
                                A/L - {{ $job->schoolLevel->al_school }} ({{ $job->schoolLevel->al_year }})
                            </li>
                            @endif


                            @if($job->userEducation)
                            <li>
                                {{ $job->userEducation->highest_education_level }} -
                                {{ $job->userEducation->educational_specialization }}

                                ({{ $job->userEducation->institute_university }})
                            </li>
                            @endif

                        </ul>

                    </div>


                </div>

            </div>



            <!-- Right Content -->
            <div class="col-xl-4 col-lg-4">

                <div class="post-details3 mb-50">

                    <div class="small-section-tittle">
                        <h4>Job Overview</h4>
                    </div>

                    <ul>

                        <li>
                            Posted date :
                            <span>{{ $job->created_at->format('d M Y') }}</span>
                        </li>

                        <li>
                            Location :
                            <span>{{ $job->detail?->city?->name ?? 'Sri Lanka' }}</span>
                        </li>

                        <li>
                            Experience :
                            <span>
                                {{ $job->professionalDetail?->total_years_experience ?? '0' }} Years
                            </span>
                        </li>

                        <li>
                            Job nature :
                            <span>
                                {{ $job->expectingArea?->job_type ?? 'Full Time' }}
                            </span>
                        </li>

                        <li>
                            Salary :
                            <span>
                                Rs {{ number_format($job->professionalDetail?->current_salary ?? 0) }}
                            </span>
                        </li>

                        <li>
                            Notice Period :
                            <span>
                                {{ $job->professionalDetail?->notice_period_days ?? 'N/A' }} Days
                            </span>
                        </li>

                    </ul>

                    <div class="apply-btn2">
                        <a href="#" class="btn">Contact Candidate</a>
                    </div>

                </div>



                <!-- Company / Candidate Info -->
                <div class="post-details4 mb-50">

                    <div class="small-section-tittle">
                        <h4>Candidate Information</h4>
                    </div>

                    <span>{{ $job->name }}</span>

                    <p>
                        {{ $job->professionalDetail?->about_current_role ?? '' }}
                    </p>

                    <ul>

                        <li>
                            Email :
                            <span>{{ $job->email }}</span>
                        </li>

                        <li>
                            Phone :
                            <span>{{ $job->phone }}</span>
                        </li>

                        <li>
                            LinkedIn :
                            <span>
                                {{ $job->socialLinks?->linkedin_link ?? 'N/A' }}
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- job post company End -->





@endsection

@push('css')
  <style>
    img.img-fluid.login-logo {
    width: 120px !important;
    }

    .billing-title {
    color: rgb(81 72 17);
    text-transform: uppercase;
    }

    #carouselExampleAutoplaying {
    width: 400px;
    }

    .services-area2 .single-services {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    background-color: #6a0000;
    padding: 29px 20px 29px 80px;
    }

    .share-dropdown {
    position: relative;
    }

    .share-dropdown .dropdown-share-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 8px 0;
    display: none;
    min-width: 200px;
    z-index: 999;
    }

    .share-dropdown:hover .dropdown-share-menu {
    display: block;
    }

    .dropdown-share-menu .dropdown-item {
    display: flex;
    align-items: center;
    padding: 6px 15px;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
    }

    .dropdown-share-menu .dropdown-item i {
    margin-right: 8px;
    font-size: 16px;
    }

    .border-btn.share-btn {
    border: 1px solid #ccc;
    padding: 8px 12px;
    /* border-radius: 4px;
    background: #f9f9f9;
    color: #333; */
    cursor: pointer;
    }

    .border-btn.share-btn:hover {
    background: #eee;
    }
  </style>
@endpush

@push('css')
  <style>

  </style>
@endpush