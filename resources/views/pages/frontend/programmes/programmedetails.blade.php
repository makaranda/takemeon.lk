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
        .single_programme_section{
            font-family: Inter, sans-serif;
            h2{
                font-size: 30px;
                font-weight: 700;
                color: #17244d;
                margin-bottom: 20px;
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
                margin-top: 0px;
                p{
                    font-size: 16px;
                    line-height: 1.8;
                    color: #17244d;
                    margin-bottom: 4px;
                }
                ul {
                    list-style: disc;
                    padding-left: 8px;
                }
            }
        }
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
