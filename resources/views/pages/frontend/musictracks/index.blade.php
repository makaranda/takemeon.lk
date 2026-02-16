@extends('layouts.frontend')

@section('content')
  @php
    
    use Carbon\Carbon;
                                            
  @endphp                                                

   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Music Tracks & Beats</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->


    <!-- music_area  -->
    <div class="music_area music_gallery all_music_tracks">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-10">
                    <div class="section_title text-center mb-65">
                        <h3>Music Tracks</h3>
                    </div>
                </div>
            </div>
                <div class="row align-items-center justify-content-center ">
                    <div class="col-xl-10">
                        @if($music_tracks && count($music_tracks) > 0)
                            @foreach ($music_tracks as $index10 => $music_track)
                                <div class="row align-items-center justify-content-center mb-20">
                                    <div class="col-xl-12">
                                        <div class="row" id="top_music_area">
                                            <div class="col-4 col-md-3 align-content-center">
                                                <img src="{{ url('public/assets/frontend/img/music_man/'.$music_track->track_image) }}" alt="{{ $music_track['title'] }}" class="img-fluid"/>
                                            </div>
                                            <div class="col-8 col-md-9">
                                                @php
                                                    
                                                    // Convert the updated_at timestamp to a Carbon instance
                                                    $givenDate3 = Carbon::parse($music_track->updated_at);
                                                    
                                                    // Format the date to show relative time (e.g., "4 months ago")
                                                    $formattedDate3 = $givenDate3->diffForHumans(['parts' => 2]);
                                                @endphp
                                               <div class="wave-path">	
                                                    <div class="song_details text-white">
                                                        <span>{{ $music_track->sub_title }}</span>
                                                        <h6>{{ $music_track->title }}</h6>
                                                    </div>
                                                    <div id="waveform-mt-{{ $index10 }}"></div>
                                                    <div class="wave-mask"></div>
                                                    <span class="published_date d-none">{{ $formattedDate3 }}</span>
                                                    <span id="currentTime-mt-{{ $index10 }}" class="time_count">0:00</span>
                                                    <div class="music_btn">
                                                        <a href="{{ $music_track->link }}" class="boxed-btn p-2" target="_blank">buy track</a>
                                                    </div>
                                                    <button id="playPause-mt-{{ $index10 }}" class="btn play_btn">
                                                       <i class="fa fa-play"></i> <!-- FontAwesome Play Icon -->
                                                    </button>
                                               </div>	
                                            </div>
                                          </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
               </div>
               <div class="row align-items-center justify-content-center">
                <div class="col-xl-10">
                    <div class="section_title text-center mb-65">
                        <h3>Music Beats</h3>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-10">
                        @if($music_beats && count($music_beats) > 0)
                            @foreach ($music_beats as $index => $music_beat)
                                <div class="row align-items-center justify-content-center mb-20">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-4 col-md-3 align-content-center">
                                                <img src="{{ url('public/assets/frontend/img/music_man/'.$music_beat->track_image) }}" alt="{{ $music_beat['title'] }}" class="img-fluid"/>
                                            </div>
                                            <div class="col-8 col-md-9">
                                                @php
                                                    
                                                    // Convert the updated_at timestamp to a Carbon instance
                                                    $givenDate2 = Carbon::parse($music_beat->updated_at);
                                                    
                                                    // Format the date to show relative time (e.g., "4 months ago")
                                                    $formattedDate2 = $givenDate2->diffForHumans(['parts' => 2]);
                                                @endphp
                                               <div class="wave-path">	
                                                    <div class="song_details text-white">
                                                        <span>{{ $music_beat->sub_title }}</span>
                                                        <h6>{{ $music_beat->title }}</h6>
                                                    </div>
                                                    <div id="waveform-{{ $index }}"></div>
                                                    <div class="wave-mask"></div>
                                                    <span class="published_date d-none">{{ $formattedDate2 }}</span>
                                                    <span id="currentTime-{{ $index }}" class="time_count">0:00</span>
                                                    <div class="music_btn">
                                                        <a href="{{ $music_beat->link }}" class="boxed-btn p-2" target="_blank">buy track</a>
                                                    </div>
                                                    <button id="playPause-{{ $index }}" class="btn play_btn">
                                                       <i class="fa fa-play"></i> <!-- FontAwesome Play Icon -->
                                                    </button>
                                               </div>	
                                            </div>
                                          </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- music_area end  -->



    <!-- youtube_video_area  -->
    {{-- <div class="youtube_video_area">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-65">
                        <h3>Music Videos</h3>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single_video">
                        <div class="thumb">
                            <img src="{{ url('public/assets/frontend/img/video/1.png') }}" alt="">
                        </div>
                        <div class="hover_elements">
                            <div class="video">
                                    <a class="popup-video" href="https://www.youtube.com/watch?v=Hzmp3z6deF8">
                                            <i class="fa fa-play"></i>
                                        </a>
                            </div>

                            <div class="hover_inner">
                                <span>New York Show-2018</span>
                                <h3><a href="#">Shadows of My Dream</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single_video">
                        <div class="thumb">
                            <img src="{{ url('public/assets/frontend/img/video/2.png') }}" alt="">
                        </div>
                        <div class="hover_elements">
                            <div class="video">
                                    <a class="popup-video" href="https://www.youtube.com/watch?v=Hzmp3z6deF8">
                                            <i class="fa fa-play"></i>
                                        </a>
                            </div>

                            <div class="hover_inner">
                                <span>New York Show-2018</span>
                                <h3><a href="#">Shadows of My Dream</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single_video">
                        <div class="thumb">
                            <img src="{{ url('public/assets/frontend/img/video/3.png') }}" alt="">
                        </div>
                        <div class="hover_elements">
                            <div class="video">
                                    <a class="popup-video" href="https://www.youtube.com/watch?v=Hzmp3z6deF8">
                                            <i class="fa fa-play"></i>
                                        </a>
                            </div>

                            <div class="hover_inner">
                                <span>New York Show-2018</span>
                                <h3><a href="#">Shadows of My Dream</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single_video">
                        <div class="thumb">
                            <img src="{{ url('public/assets/frontend/img/video/4.png') }}" alt="">
                        </div>
                        <div class="hover_elements">
                            <div class="video">
                                    <a class="popup-video" href="https://www.youtube.com/watch?v=Hzmp3z6deF8">
                                            <i class="fa fa-play"></i>
                                        </a>
                            </div>

                            <div class="hover_inner">
                                <span>New York Show-2018</span>
                                <h3><a href="#">Shadows of My Dream</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- / youtube_video_area  -->

@endsection


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
        .music_area {
            position: relative;
            margin-top: -164px;
        }
        .wave-path {
            position: relative;
            height: 130px;
            justify-content: center;
            align-content: end;
            .wave-mask{
                width: 100%;
                height: 24px;
                background: #ffffff70;
                position: absolute;
                bottom: 0px;
                z-index: 2;
            }
            .play_btn{
                position: absolute;
                top: 10px;	
                z-index: 6;
                background-color: #f50;
                border-radius: 30px;
                font-size: 11px;
                color: #fff;
            }
            .time_count{
                position: absolute;
                top: 20px;
                right: 1px;
                background: #0000009e;
                z-index: 6;
                color: #fff;
                padding: 4px;
                font-size: 11px;		
            }
            .song_details{
                position: absolute;
                top: 0px;
                left: 42px;
                span{
                    font-size: 10px;
                }
                h6{
                    font-size: 11px;
                }
            }
            .published_date{
                position: absolute;
                top: 5px;
                right: 0px;
                font-size: 9px;
                color: #fff;
                text-transform: capitalize;
            }
            &:hover #waveform {
                filter: brightness(1.2);
                cursor:pointer;
                opacity:1;
            }
        }
        .about_info p {
            margin-top: 10px !important;
            margin-bottom: 10px !important;
        }
        
        .all_music_tracks{
            .song_details{
                span{
                    color: #000;
                }
                h6{
                    color: #000;
                }
            }
            .music_btn{
                position: absolute;
                right: 50px;
                top: 2px;
                a{
                
                }
            }
        }
    </style>
@endpush
@push('scripts')

<script src="https://unpkg.com/wavesurfer.js"></script>

<script>
        $(document).ready(function () {

            function formatTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                let remainingSeconds = seconds % 60;
                return minutes + ":" + (remainingSeconds < 10 ? "0" : "") + remainingSeconds;
            }

            // Music Tracks
            @foreach ($music_tracks as $index2 => $music_track)
                if ($('#waveform-mt-{{ $index2 }}').length) {
                    let wavesurfer_mt_{{ $index2 }} = WaveSurfer.create({
                        container: '#waveform-mt-{{ $index2 }}',
                        waveColor: 'gray',
                        progressColor: 'orange',
                        barWidth: 3,
                        barGap: 2,
                        barHeight: 2,
                        height: 80,
                        normalize: true,
                        backend: 'WebAudio'
                    });

                    let trackUrlMt = '{{ asset("public/assets/frontend/audios/" . $music_track["track"]) }}';

                    fetch(trackUrlMt, { method: 'HEAD' })
                        .then(response => {
                            if (response.ok) {
                                wavesurfer_mt_{{ $index2 }}.load(trackUrlMt);

                                $('#playPause-mt-{{ $index2 }}').click(function () {
                                    wavesurfer_mt_{{ $index2 }}.playPause();
                                    $(this).find('i').toggleClass('fa-play fa-pause');
                                });

                                wavesurfer_mt_{{ $index2 }}.on('audioprocess', function () {
                                    let time = Math.floor(wavesurfer_mt_{{ $index2 }}.getCurrentTime());
                                    $('#currentTime-mt-{{ $index2 }}').text(formatTime(time));
                                });
                            } else {
                                console.error("Track file not found: " + trackUrlMt);
                            }
                        })
                        .catch(error => console.error("Error fetching track:", error));
                }
            @endforeach
            
            // Music Beats
            @foreach ($music_beats as $index20 => $music_beat)
                if ($('#waveform-{{ $index20 }}').length) {
                    let wavesurfer_{{ $index20 }} = WaveSurfer.create({
                        container: '#waveform-{{ $index20 }}',
                        waveColor: 'gray',
                        progressColor: 'orange',
                        barWidth: 3,
                        barGap: 2,
                        barHeight: 2,
                        height: 80,
                        normalize: true,
                        backend: 'WebAudio'
                    });

                    let trackUrlMb = '{{ asset("public/assets/frontend/audios/" . $music_beat["track"]) }}';

                    fetch(trackUrlMb, { method: 'HEAD' })
                        .then(response => {
                            if (response.ok) {
                                wavesurfer_{{ $index20 }}.load(trackUrlMb);

                                $('#playPause-{{ $index20 }}').click(function () {
                                    wavesurfer_{{ $index20 }}.playPause();
                                    $(this).find('i').toggleClass('fa-play fa-pause');
                                });

                                wavesurfer_{{ $index20 }}.on('audioprocess', function () {
                                    let time = Math.floor(wavesurfer_{{ $index20 }}.getCurrentTime());
                                    $('#currentTime-{{ $index20 }}').text(formatTime(time));
                                });
                            } else {
                                console.error("Track file not found: " + trackUrlMb);
                            }
                        })
                        .catch(error => console.error("Error fetching track:", error));
                }
            @endforeach
        });
    </script>
@endpush
