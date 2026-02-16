@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>About Me</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

    <!-- about_area  -->
    <div class="about_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-12">
                    <div class="about_info pl-0">
                        <h3>King Viking</h3>
                        <p class="pt-0 mb-0">When I look back, music has been the only constant. In another lifetime, I could have been that guy - where I come from, climbing a coconut tree is still a respectabel job for a daily wage. But lucky for me, that possibility was taken out of the equation.  </p>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="about_thumb">
                        <img class="img-fluid" src="{{ url('public/assets/frontend/img/king-viking-about-poster.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="about_info">
                        <p class="pt-0 mb-0">It didnt matter what came next, the love for song writing was there waiting to color any  lane I picked. It truely knows no cultural barriers. It adopts, heals, finds solutions for complex problems. So I keep writing music. But I cant help think about that other possibility that could have narrated this life. I am greatful to music. I am always greatful for those that made it possible for me. Doesnt matter where it goes from here, because of you, I consider mine to be a successful story.</p>
                        <p class="pt-0 mb-0">Thank you for stopping by. I hope we can collaborate and make butiful music someday.</p>
                        <div class="signature">
                            <img src="{{ url('public/assets/frontend/img/about/signature.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ about_area  -->

<div class="singer_video">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="image">
                    <img src="{{ url('public/assets/frontend/img/about/singer-king-viking.jpg') }}" alt="">
                    <div class="video_btn">
                        <a class="popup-video" href="{{ url('public/assets/uploads/videos/about-video.mp4') }}"><i class="fa fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- gallery -->
    <div class="gallery_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-65">
                        <h3>Image Galleries</h3>
                    </div>
                </div>
            </div>
            <div class="row grid">
                    <div class="col-xl-5 col-lg-5 grid-item cat1 col-md-6">
                        <div class="single-gallery mb-30">
                                <div class="portfolio-img">
                                    <img src="{{ url('public/assets/frontend/img/gallery/img-gallery-001.jpg') }}" alt="" class="img-fluid">
                                </div>
                                <div class="gallery_hover">
                                    <a  class="popup-image"  href="{{ url('public/assets/frontend/img/gallery/img-gallery-001.jpg') }}" class="hover_inner">
                                        <i class="ti-plus"></i>
                                    </a>
                                </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 grid-item cat3 cat4 col-md-6">
                        <div class="single-gallery mb-30">
                                <div class="portfolio-img">
                                        <img src="{{ url('public/assets/frontend/img/gallery/img-gallery-002.jpg') }}" alt="">
                                </div>
                                <div class="gallery_hover">
                                        <a class="popup-image" href="{{ url('public/assets/frontend/img/gallery/img-gallery-002.jpg') }}" class="hover_inner">
                                            <i class="ti-plus"></i>
                                        </a>
                                </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 grid-item cat4 col-md-6">
                        <div class="single-gallery mb-30">
                                <div class="portfolio-img">
                                        <img src="{{ url('public/assets/frontend/img/gallery/img-gallery-003.jpg') }}" alt="">
                                </div>
                                <div class="gallery_hover">
                                        <a class="popup-image" href="{{ url('public/assets/frontend/img/gallery/img-gallery-003.jpg') }}" class="hover_inner">
                                            <i class="ti-plus"></i>
                                        </a>
                                </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 grid-item cat2 col-md-6">
                        <div class="single-gallery mb-30">
                            <div class="portfolio-img">
                                    <img src="{{ url('public/assets/frontend/img/gallery/img-gallery-004.jpg') }}" alt="">
                            </div>
                            <div class="gallery_hover">
                                    <a class="popup-image" href="{{ url('public/assets/frontend/img/gallery/img-gallery-004.jpg') }}" class="hover_inner">
                                        <i class="ti-plus"></i>
                                    </a>
                                </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 grid-item cat2 col-md-6">
                        <div class="single-gallery mb-30">
                            <div class="portfolio-img">
                                    <img src="{{ url('public/assets/frontend/img/gallery/img-gallery-005.jpg') }}" alt="">
                            </div>
                            <div class="gallery_hover">
                                    <a class="popup-image" href="{{ url('public/assets/frontend/img/gallery/img-gallery-005.jpg') }}" class="hover_inner">
                                        <i class="ti-plus"></i>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!--/ gallery -->

@endsection

@push('css')
    <style>
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
