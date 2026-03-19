@extends('layouts.frontend')

@section('content')

@php
    $icons = [
    'accounting-and-finance' => 'flaticon-report',
    'automobiles' => 'flaticon-car',
    'agriculture-and-food-processing' => 'flaticon-wheat',
    'civil-and-construction' => 'flaticon-helmet',
    'it-and-telecommunications' => 'flaticon-high-tech',
    'real-estate' => 'flaticon-real-estate',
    'healthcare' => 'flaticon-doctor',
    'digital-marketing' => 'flaticon-content',
    'consulting' => 'flaticon-tour',
    'bpo-kpo' => 'flaticon-report',
    'banking-and-financial-services' => 'flaticon-real-estate',
    'administration' => 'flaticon-content',
    'automobiles' => 'flaticon-high-tech',
    'agriculture-and-food-processing' => 'flaticon-curriculum-vitae'
    ];
@endphp
<!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/h1_hero.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-md-10">
                                <div class="hero__caption">
                                    <h1>Find the most exciting startup jobs</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- form -->
                                <form action="#" class="home-section-hero search-box">
                                    
                                    <div class="select-form1">
                                        <div class="select-itms1">
                                            <select name="select_industry" id="select_industry">
                                                <option value="">Select </option>
                                                @if($industries)
                                                    @foreach ($industries as $industry)
                                                        <option value="{{  $industry->slug  }}">{{ $industry->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="select-form2">
                                        <div class="select-itms2">
                                            <select name="select_role" id="select_role">
                                                <option value="">Select </option>
                                                @if($designations)
                                                    @foreach ($designations as $designation)
                                                        <option value="{{  $designation->slug  }}">{{ $designation->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="search-form">
                                        <a href="#">Find job</a>
                                    </div>	
                                </form>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- Our Services Start -->
        <div class="our-services section-pad-t30">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>FEATURED Packages</span>
                            <h2>Browse Top Categories </h2>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-contnet-center">

                    @if ($industries_lists->count() > 0)
                        @foreach ($industries_lists as $industries_list)
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                <div class="single-services text-center mb-30">
                                    <div class="services-ion">
                                        <span class="{{ $icons[$industries_list->slug] ?? 'flaticon-briefcase' }}"></span>
                                    </div>
                                    <div class="services-cap">
                                        <h5>
                                            @if ($industry->candidates_count > 0)
                                                <a href="{{ route('frontend.job.category', $industries_list->slug) }}">
                                                    {{ $industries_list->name }}
                                                </a>
                                            @else
                                                <a data-id="{{ $industries_list->name }}" class="msg_no_category cursor-pointer">
                                                    {{ $industries_list->name }}
                                                </a>
                                            @endif
                                            
                                        </h5>
                                        <span>{{ $industry->candidates_count > 0 ? '(' . $industry->candidates_count . ')' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- More Btn -->
                <!-- Section Button -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="browse-btn2 text-center mt-50">
                            <a href="{{ route('frontend.home.jobs') }}" class="border-btn2">Browse All Sectors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Services End -->
        <!-- Online CV Area Start -->
         <div class="online-cv cv-bg section-overly pt-90 pb-120"  data-background="{{ url('public/assets/frontend/img/gallery/cv_bg.jpg') }}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="cv-caption text-center">
                            <p class="pera1">FEATURED Packages</p>
                            <p class="pera2"> Make a Difference with Your Online Resume!</p>
                            <a href="{{ route('frontend.userregister') }}" class="border-btn2 border-btn4">Upload your cv</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Online CV Area End-->
        <!-- Featured_job_start -->
        <section class="featured-job-area feature-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Recent Job</span>
                            <h2>Featured Jobs</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <!-- single-job-content -->
                        @if ($jobs->count() > 0)
                            @foreach ($jobs as $job)
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="{{ route('frontend.job.view', $job->slug) }}">
                                                <img src="{{ asset('public/assets/frontend/candidates/' . ($job->detail?->profile_img ?? 'user_profile.png')) }}" alt="{{ $job->name }}">
                                            </a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="{{ route('frontend.job.view', $job->slug) }}"><h4>{{ $job->name }}</h4></a>
                                            <ul>
                                                <li>{{ $job->latestPastEmployment?->company_name ?? 'Company Not Available' }}</li>
                                                <li><i class="fas fa-map-marker-alt"></i>{{ $job->detail?->city?->name ?? 'Sri Lanka' }}</li>
                                                <li>
                                                    @php
                                                        $salary = $job->expectingArea?->expected_salary;
                                                    @endphp
                                                    @if ($salary && $salary > 0)
                                                        Rs {{ number_format($salary) }}
                                                    @else
                                                        Salary Negotiable
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="{{ route('frontend.job.view', $job->slug) }}">{{ $job->expectingArea?->job_type ?? 'Full Time' }}</a>
                                        <span>{{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>     
                            @endforeach
                        @endif
                         <!-- single-job-content -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured_job_end -->
        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="{{ url('public/assets/frontend/img/gallery/how-applybg.png') }}">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span>Apply process</span>
                            <h2> How it works</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                               <h5>1. Search a job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                               <h5>2. Apply for job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                               <h5>3. Get your job</h5>
                               <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <!-- How  Apply Process End-->
        <!-- Testimonial Start -->
        <div class="testimonial-area testimonial-padding">
            <div class="container">
                <!-- Testimonial contents -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-10">
                        <div class="h1-testimonial-active dot-style">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder  ">
                                        <div class="founder-img mb-30">
                                            <img src="{{ url('public/assets/frontend/img/testmonial/testimonial-founder.png') }}" alt="">
                                            <span>Margaret Lawson</span>
                                            <p>Creative Director</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“I am at an age where I just want to be fit and healthy our bodies are our responsibility! So start caring for your body and it will care for you. Eat clean it will care for you and workout hard.”</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder  ">
                                        <div class="founder-img mb-30">
                                            <img src="{{ url('public/assets/frontend/img/testmonial/testimonial-founder.png') }}" alt="">
                                            <span>Margaret Lawson</span>
                                            <p>Creative Director</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“I am at an age where I just want to be fit and healthy our bodies are our responsibility! So start caring for your body and it will care for you. Eat clean it will care for you and workout hard.”</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder  ">
                                        <div class="founder-img mb-30">
                                            <img src="{{ url('public/assets/frontend/img/testmonial/testimonial-founder.png') }}" alt="">
                                            <span>Margaret Lawson</span>
                                            <p>Creative Director</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“I am at an age where I just want to be fit and healthy our bodies are our responsibility! So start caring for your body and it will care for you. Eat clean it will care for you and workout hard.”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
         <!-- Support Company Start-->
         <div class="support-company-area support-padding fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <span>What we are doing</span>
                                <h2>24k Talented people are getting Jobs</h2>
                            </div>
                            <div class="support-caption">
                                <p class="pera-top">Mollit anim laborum duis au dolor in voluptate velit ess cillum dolore eu lore dsu quality mollit anim laborumuis au dolor in voluptate velit cillum.</p>
                                <p>Mollit anim laborum.Duis aute irufg dhjkolohr in re voluptate velit esscillumlore eu quife nrulla parihatur. Excghcepteur signjnt occa cupidatat non inulpadeserunt mollit aboru. temnthp incididbnt ut labore mollit anim laborum suis aute.</p>
                                <a href="{{ route('frontend.about') }}" class="btn post-btn">Who we Are</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img">
                            <img src="{{ url('public/assets/frontend/img/service/support-img.jpg') }}" alt="">
                            <div class="support-img-cap text-center">
                                <p>Since</p>
                                <span>1994</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- Blog Area Start -->
        <div class="home-blog-area blog-h-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Our latest blog</span>
                            <h2>Our recent news</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($blogs->count() > 0)
                        @foreach ($blogs as $blog)
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="home-blog-single mb-30">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="{{ asset('public/assets/uploads/blogs/'.$blog->feature_image) }}" alt="">
                                            <!-- Blog date -->
                                            <div class="blog-date text-center">
                                                <span>{{ $blog->created_at->format('d') }}</span>
                                                <p>{{ $blog->created_at->format('M') }}</p>
                                            </div>
                                        </div>
                                        <div class="blog-cap">
                                            <p>{{ $blog->category?->name ?? 'General' }}</p>
                                            <h3><a href="{{ route('frontend.blog.view',$blog->slug) }}">{{ $blog->title }}</a></h3>
                                            <a href="{{ route('frontend.blog.view',$blog->slug) }}" class="more-btn">Read more »</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        <!-- Blog Area End -->



@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        .select-form1 {
            .nice-select{
                display: none;
            }
            .select2-container{
                .selection{
                    .select2-selection--single {
                        height: 70px;
                        .select2-selection__rendered{
                            height: 70px;
                            align-content: center;
                        }
                        .select2-selection__arrow{
                            height: 70px;
                        }
                    }
                }
            }
        }
        .select-form2 {
            .nice-select{
                display: none;
            }
            .select2-container{
                .selection{
                    .select2-selection--single {
                        height: 70px;
                        .select2-selection__rendered{
                            height: 70px;
                            align-content: center;
                        }
                        .select2-selection__arrow{
                            height: 70px;
                        }
                    }
                }
            }
        }
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .add_width{
            width:450px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
        .music_area {
            position: relative;
            margin-top: -164px;
        }
        
        .about_info p {
            margin-top: 10px !important;
            margin-bottom: 10px !important;
        }

        .swiper-slide a img {
            width: 100% !important;
        }
    </style>
@endpush
@push('scripts')
    {{-- <script src="https://unpkg.com/wavesurfer.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            
            $('.msg_no_category').on('click',function(){
                let getName = $(this).attr('data-id');
                console.log('Cat Name: '+getName);
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    text: "There are no any candidate registered Under This category "+getName+", Then you can not visit this category.",
                    timer: 12000,
                    position: "bottom-end",
                    showConfirmButton: false
                });
            });

            $('#select_industry').select2({
                placeholder: "Select Industry",
                allowClear: true
            });

            $('#select_role').select2({
                placeholder: "Select Role",
                allowClear: true
            });

        });
    </script>
    <script>


        // document.addEventListener('DOMContentLoaded', function () {
        //     new Swiper('.partner__carousel', {
        //         loop: true,
        //         autoplay: {
        //             delay: 3000,
        //             disableOnInteraction: false,
        //         },
        //         pagination: {
        //             el: '.partners_carouser__pagination-1',
        //             clickable: true,
        //         },
        //         slidesPerView: 2,
        //         spaceBetween: 30,
        //         breakpoints: {
        //             576: {
        //                 slidesPerView: 3,
        //             },
        //             768: {
        //                 slidesPerView: 4,
        //             },
        //             992: {
        //                 slidesPerView: 5,
        //             },
        //             1200: {
        //                 slidesPerView: 6,
        //             }
        //         }
        //     });
        // });
    </script>

@endpush
