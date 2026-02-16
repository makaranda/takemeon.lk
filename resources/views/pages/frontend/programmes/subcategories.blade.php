@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{ $program_sub_categories['name'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->

 <!-- ================ contact section start ================= -->
 <section class="contact-section section_padding programme_section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">{{ $program_sub_categories['name'] }}</h2>
        </div>

        <div class="col-12 col-md-12 mt-10">
            <div class="row">
                <!--<div class="col-12 col-md-12">
                    <h4 class="programme_header">Find Your Programme</h4>
                </div>-->
                @php
                    //var_dump($program_sub_categories->slug);
                    $programme_cat_details = \App\Models\Programme::where('slug','LIKE','%'.$program_sub_categories->slug.'%')->where('status',1)->first();
                @endphp
                <div class="col-12 col-md-12 programme_section_description">
                    {!! $programme_cat_details->sub_description !!}
                </div>
                <div class="col-12 col-md-12 programme_section_description">
                    {!! $programme_cat_details->description !!}
                </div>
                <div class="col-12 col-md-12 mt-20">
                    <div class="row">
                        @if ($program_sub_categories)
                                <div class="col-12 col-md-12">
                                    <!--<div class="row">
                                        <div class="col-12 col-md-12">
                                            <h4 class="programme_cat">
                                                
                                            </h4>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                       @foreach ($program_sub_category_items as $item)
                                            @if ($item['sub_category_id'] == $program_sub_categories['id'])
                                                <div class="col-12 col-md-6 mt-15">
                                                    {{-- <a href="{{ route('frontend.programme.subcategory', ['slug' => $program_sub_categories['slug'], 'sub_slug' => $item['slug']]) }}">
                                                        <img src="{{ url('public/assets/frontend/images/image1.webp') }}" alt="{{ $settings['website_name'] }}" class="img-fluid hvr-grow cursor-pointer" />
                                                    </a> --}}
                                                    <a href="{{ route('frontend.programme.subcategory', ['slug' => $program_sub_categories['slug'], 'sub_slug' => $item['slug']]) }}" class="btn btn-outline-primary btn-sm mb-2 programme_cat_btn">{{ $item->name }}</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                        @endif
                    </div>
                </div>
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
        .programme_cat {
            width: 100%;
            text-align: left;
            padding: 12px 0px;
            font-size: 18px;
        }
        .programme_cat_btn {
            width: 100%;
            text-align: left;
            padding: 12px 25px;
            font-size: 18px;
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
                    font-size: 30px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h3{
                    margin-bottom: 8px;
                    font-size: 25px;
                    line-height: 1.8;
                    margin-top: 15px;
                }
                h4{
                    margin-bottom: 8px;
                    font-size: 20px;
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
