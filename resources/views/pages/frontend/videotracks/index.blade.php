@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Music Videos</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->
<div class="youtube_video_area mt-4 mb-4">
    <div class="container-fluid">
        <div class="row">
            @if ($video_tracks && count($video_tracks) > 0)
                @foreach ($video_tracks as $video_track)
                    <div class="col-xl-3 col-lg-3 col-md-6 pt-4">
                        <div class="single_video">
                            <div class="thumb">
                                <img src="{{ url('public/assets/frontend/img/video/'.$video_track['track_image']) }}" alt="">
                            </div>
                            <div class="hover_elements">
                                <div class="video">
                                    <a class="popup-video" href="{{ $video_track['track'] }}">
                                            <i class="fa fa-play"></i>
                                    </a>
                                </div>

                                <div class="hover_inner">
                                    {{-- <span>{{ $video_track['sub_title'] }}</span> --}}
                                    <h3><a href="#">{{ $video_track['title'] }}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                
            @endif
            
        </div>
    </div>
</div>

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
