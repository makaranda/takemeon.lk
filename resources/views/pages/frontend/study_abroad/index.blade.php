@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>About Us</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

     <!-- about_area  -->
     <div class="about_area pb-5 mt-25">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-12">
                    <div class="about_info pl-0">
                        <h3>About Us</h3>
                        <p class="pt-0 mb-0">{!! $about_info['sub_description'] !!}</p>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="about_thumb">
                        <img class="img-fluid" src="{{ asset('public/assets/uploads/pages/' . $about_info['feature_image']) }}" alt="About King Viking"/>
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="about_info">
                        <p class="pt-0 mb-0">{!! $about_info['description'] !!}</p>
                        <p class="pt-0 mb-0">Thank you for stopping by. I hope we can collaborate and make butiful music someday.</p>
                        <!--<div class="signature">
                            <img src="{{ url('public/assets/frontend/img/about/signature.png') }}" alt="">
                        </div>-->
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
                @if(isset($about_info['video_image'],$about_info['video']))
                <div class="image">
                    <img src="{{ url('public/assets/uploads/images/'.$about_info['video_image']) }}" alt="">
                    <div class="video_btn">
                        <a class="popup-video" href="{{ url('public/assets/uploads/videos/'.$about_info['video']) }}"><i class="fa fa-play"></i></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


    <!-- gallery -->

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
