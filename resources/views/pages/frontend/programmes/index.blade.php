@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Programmes</h3>
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
          <h2 class="contact-title">Programmes</h2>
        </div>
        <div class="col-12 col-md-12">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4 class="programme_header"><span class="programme_header_tag">20+</span> Programmes offered from various fields</h4>
                </div>
                <div class="col-12 col-md-6">
                    <div>{{ $settings['footer_content'] }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 mt-30">
            <div class="row">
                <div class="col-6 col-md-3">
                    <img src="{{ url('public/assets/frontend/images/image1.webp') }}" alt="{{ $settings['website_name'] }}" class="img-fluid hvr-grow cursor-pointer" />
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ url('public/assets/frontend/images/image2.webp') }}" alt="{{ $settings['website_name'] }}" class="img-fluid hvr-grow cursor-pointer" />
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ url('public/assets/frontend/images/image3.webp') }}" alt="{{ $settings['website_name'] }}" class="img-fluid hvr-grow cursor-pointer" />
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ url('public/assets/frontend/images/image4.webp') }}" alt="{{ $settings['website_name'] }}" class="img-fluid hvr-grow cursor-pointer" />
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 mt-35">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h4 class="programme_header">Find Your Programme</h4>
                </div>
                <div class="col-12 col-md-12">
                    <div class="row">
                        @if ($program_categories)
                            @foreach ($program_categories as $category)
                                <div class="col-12 col-md-6 mt-10">
                                    <a href="{{ route('frontend.programme.category', $category->slug) }}" class="btn btn-outline-primary btn-sm mb-2 programme_cat_btn">{{ $category->name }}</a>
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
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
        .programme_cat_btn {
            width: 100%;
            text-align: left;
            padding: 12px 25px;
            font-size: 18px;
        }
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
