@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Careers</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->

 <!-- ================ contact section start ================= -->
 <section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Careers</h2>
        </div>
        <div class="col-lg-8">
            <div>
                {!! $career_page->sub_description !!}
            </div>
        </div> 
        <div class="col-lg-8">
            <div>
                {!! $career_page->description !!}
            </div>
        </div>    
        <div class="col-lg-8">
            <div class="row">
                @if ($careers)
                    @foreach ($careers as $career)
                        <div class="col-6 col-md-4">
                            <div class="row">
                                <div class="col-12 col-md-12 programme_cat">
                                    <a href="{{ route('frontend.careers.singleview', $career->slug) }}" class="programme_cat_btn">
                                        <h4 class="programme_cat_title">
                                            {{ $career->title }}
                                        </h4>
                                        <img src="{{ url('public/assets/uploads/careers/' . $career->feature_image) }}" alt="{{ $career->title }}" class="img-fluid hvr-grow cursor-pointer programme_cat_img" />
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
  </section>
  <!-- ================ contact section end ================= -->

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
            background-image: url('{{ asset('public/assets/frontend/img/banner/'.$career_page['banner_image']) }}') !important;
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
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
