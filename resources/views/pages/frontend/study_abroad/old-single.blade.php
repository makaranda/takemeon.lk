@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
<div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>{{ $study_abroad['title'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->


<div class="about_area pb-5 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0">
                    <p class="pt-0 mb-0">{!! $study_abroad['sub_description'] !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="about_area pb-25 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0">
                    <div class="text-center w-100"><img src="{{ url('public/assets/frontend/countries/'.$country->image) }}" class="img-fluid"/></div>
                </div>
            </div>    
        </div>
    </div>
</div>


<div class="about_area pb-25 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0">
                   <h3>Why {{ $country->name }}?</h3>
                </div>
            </div>    
        </div>
    </div>
</div>

<div class="about_area pb-25 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0 w-100">
                    <div class="row links">
                        @if($university_links)
                            @foreach($university_links as $link)
                                <div class="col-6 col-sm-4 col-md-3 text-center mt-10">
                                    <a href="{{ $link->link }}" target="_blank" class="card">
                                        <h5 class="pt-6 pb-6 mb-0">{{ $link->name }}</h5>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<div class="about_area pb-25 mt-25">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-12">
                <div class="study_abroad pl-0">
              
                    <h3>Most Demanding Fields and Courses</h3>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0">
                    <p class="pt-0 mb-0">{!! $study_abroad['description'] !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- {{ var_dump($universities) }} --}}
 {{-- <section class="contact-section section_padding programme_section">
    <div class="container">
      <div class="row">
        <div class="about_area pb-5 mt-25">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-12 mt-25">
                        <div class="row">
                            @if ($universities)
                                @foreach ($universities as $university)
                                    <div class="col-6 col-md-3">
                                        <div class="row">
                                            <div class="col-12 col-md-12 programme_cat">

                                                <a href="{{ $university['link'] }}" class="programme_cat_btn" target="_blank">
                                                    <h4 class="programme_cat_title">
                                                        {{ $university['name'] }}
                                                    </h4>
                                                    <img src="{{ url('public/assets/frontend/universities/'.$university['image']) }}" alt="{{ $university['name'] }}" class="img-fluid hvr-grow cursor-pointer programme_cat_img" />
                                                </a>
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
        </div>
    </div>
</section> --}}


<div class="about_area pb-5 mt-25">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-12">
                <div class="study_abroad pl-0">
                    <h3>Universities</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="contact-section section_padding programme_section">
  <div class="container">
    <div id="universityCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        @php
            $chunks = $universities->chunk(4);
        @endphp

        @foreach ($chunks as $chunkIndex => $chunk)
          <div class="carousel-item @if($chunkIndex === 0) active @endif">
            <div class="row">
              @foreach ($chunk as $university)
                <div class="col-6 col-md-3">
                  <div class="programme_cat">
                    <a href="{{ $university['link'] }}" class="programme_cat_btn" target="_blank">
                      <h4 class="programme_cat_title">{{ $university['name'] }}</h4>
                      <img src="{{ url('public/assets/frontend/universities/'.$university['image']) }}" alt="{{ $university['name'] }}" class="img-fluid hvr-grow cursor-pointer programme_cat_img" />
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach

      </div>

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#universityCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#universityCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</section>

 <!-- ===============>> Partner section start here <<================= -->
{{-- <section class="partner pt-50 pb-50" data-aos="fade-up" data-aos-duration="800">
    <div class="container mb-4">
        <div class="row mb-4">
            <div class="col-12 item-flex-center mb-20">
                <h2 class="relative title-underline-cus2">Universities</h2>
            </div>
        </div>
        <div class="swiper partner__carousel">
            <div class="swiper-wrapper">
                <!-- Partner Item Start -->
                @if ($universities)
                    @foreach ($universities as $university)
                        <div class="swiper-slide partners-main px-2 py-4 item-flex-center">
                            <a href="{{ $university->link ?? '#' }}" target="_blank">
                                <img data-src="{{ url('public/assets/frontend/universities/'.$university->image) }}" alt="{{ $university->name }}" />
                            </a>
                        </div>
                    @endforeach
                @endif
                <!-- Partner Item End -->
            </div>
            <!-- Pagination -->
            <div class="partners_carouser__pagination-1 text-center mt-4"></div>
        </div>
    </div>
</section> --}}
<!-- ===============>> Partner section end here <<================= -->


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
        .breadcam_bg_2{
            background-image: url('{{ asset('public/assets/frontend/img/banner/'.$study_abroad['banner_image']) }}') !important;
            background-size: cover;
            background-position: center;
        }

        .programme_section{
            .programme_section_sub{
                p{
                    margin-bottom: 6px;
                    font-size: 16px;
                    line-height: 1.4;
                }
                h2{
                    margin-bottom: 8px;
                    font-size: 20px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h3{
                    margin-bottom: 8px;
                    font-size: 19px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h4{
                    margin-bottom: 8px;
                    font-size: 18px;
                    line-height: 1.8;
                    margin-top: 15px;
                }

                table{
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                    th, td{
                        padding: 10px;
                        border: 1px solid #ddd;
                        text-align: left;
                        border-right: 1px solid #ccc !important;
                    }
                    tr{
                        border: 1px solid #ccc;
                    }
                    th{
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                }
            }
            .programme_section_description{
                p{
                    margin-bottom: 6px;
                    font-size: 16px;
                    line-height: 1.4;
                }
                h2{
                    margin-bottom: 8px;
                    font-size: 20px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h3{
                    margin-bottom: 8px;
                    font-size: 19px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h4{
                    margin-bottom: 8px;
                    font-size: 18px;
                    line-height: 1.8;
                    margin-top: 15px;
                }

                table{
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                    th, td{
                        padding: 10px;
                        border: 1px solid #ddd;
                        text-align: left;
                        border-right: 1px solid #ccc !important;
                    }
                    tr{
                        border: 1px solid #ccc;
                    }
                    th{
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                }
            }
        }
        .programme_cat{
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;

            .programme_cat_btn {
                width: 100%;
                text-align: left;
                font-size: 18px;
                .programme_cat_title {
                    width: 95%;
                    text-align: left;
                    font-size: 18px;
                    position: absolute;
                    height: 60px;
                    z-index: 9;
                    bottom: 0px;
                    text-align: center;
                    color: #fff;
                    align-content: center;
                    background-color: #00000075;
                    margin-bottom: 0px;
                }
                .programme_cat_img {
                    width: 100%;
                    height: auto;
                    transition: all 0.3s ease;
                }
            }
        }
        .study_abroad{
            .links{
                .card{
                    background-color: #e9b11f;
                    &:hover{
                        background-color: #c38d00;
                    }
                }
            }
        }
        .owl-item {
            width: 100% !important;
        }
    </style>
@endpush

@push('scripts')
    <style>

    </style>
@endpush
