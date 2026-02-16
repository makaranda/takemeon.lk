@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{ $programme['title'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->

 <!-- ================ contact section start ================= -->
 <section class="contact-section section_padding single_programme_section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">{{ $programme['title'] }}</h2>
        </div>
        <div class="col-lg-8 description">
          {!! $programme['description'] !!}
        </div>
        <div class="col-lg-4 sub_description">
          {!! $programme['sub_description'] !!}
        </div>
      </div>
      <div class="row">
         <div class="col-12 col-md-12 mt-30">
            <div class="swiper partner__carousel">
                <div class="swiper-wrapper">
                    <div class="accordion w-100" id="accordionWhyChooseUs">
                        @if ($accordings)
                            @php
                                $accor_no = 0;
                            @endphp
                            @foreach ($accordings as $according)
                                @php
                                    $accor_no = $accor_no + 1;
                                @endphp
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $accor_no == 1 ? '' : 'collapsed' }}"  type="button" data-bs-toggle="collapse" data-bs-target="#collaps_wcu_{{ $accor_no }}" aria-expanded="{{ $accor_no == 1 ? 'true' : 'false' }}" aria-controls="collaps_wcu_{{ $accor_no }}">
                                        {{ $according->topic }}
                                        </button>
                                    </h2>
                                    <div id="collaps_wcu_{{ $accor_no }}" class="accordion-collapse pl-15 collapse {{ $accor_no == 1 ? 'show' : '' }}" data-bs-parent="#accordionWhyChooseUs">
                                        <div class="accordion-body">
                                        <h6 class="fw-bold">{{ $according->sub_topic }}</h6>
                                        <div>{!! $according->description !!}</div>
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
  </section>
  <!-- ================ contact section end ================= -->

@endsection

@push('css')
    <style>
        #accordionWhyChooseUs{
            ul{
                li{
                    list-style: disc !important;
                    a{
                    
                    }
                }
            }
        }
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
        .single_programme_section{
            font-family: Inter, sans-serif;
            h2{
                font-size: 30px;
                font-weight: 700;
                color: #17244d;
                margin-bottom: 4px;
            }
            h4{
                font-size: 24px;
                font-weight: 700;
                color: #17244d;
                margin-bottom: 20px;
            }
            p{
                font-size: 16px;
                line-height: 1.8;
                color: #17244d;
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
            .description{
                table{
                    thead{
                        th, td{
                            background-color: #8e8efd;
                            p{
                                span{
                                    font-size: 14px;
                                }
                            }
                        }
                    }
                    tbody{
                        tr:nth-child(odd) {
                            background-color: #f0f0ff; /* Light color for odd rows */
                        }
                        tr:nth-child(even) {
                            background-color: #e0e0f8; /* Slightly different color for even rows */
                        }
                        th, td{
                            p{
                                span{
                                    font-size: 14px;
                                }
                            }
                        }
                    }
                }
            }
            .sub_description{
                background-color: #ffebb6;
                padding: 20px;
                border-radius: 5px;
                margin-top: 10px;
                p{
                    font-size: 16px;
                    line-height: 1.8;
                    color: #17244d;
                    margin-bottom: 4px;
                }
                ul {
                    list-style: disc;
                    padding-left: 8px;
                    li{
                        margin-left: 10px;
                    }
                }
            }
            .description{
                p{
                    font-size: 16px;
                    line-height: 1.8;
                    color: #17244d;
                    margin-bottom: 10px;
                }
                ul {
                    list-style: disc;
                    padding-left: 8px;
                    li{
                        margin-left: 10px;
                    }
                }
            }
        }
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
