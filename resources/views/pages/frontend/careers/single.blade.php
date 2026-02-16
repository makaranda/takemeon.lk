@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{ $career['title'] }}</h3>
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
          <h2 class="contact-title">{{ $career['title'] }}</h2>
        </div>
        <div class="col-lg-8">
          {!! $career['sub_description'] !!}
        </div>
        <div class="col-lg-8">
          {!! $career['description'] !!}
        </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-12">
              <h3>Please send your CV to</h3>
          </div>
          <div class="col-12 col-md-12">
              <a href="mailto:{{ $career['email'] }}">{{ $career['email'] }}</a>
          </div>
          <div class="col-12 col-md-12">
              <a href="https://wa.me/{{ $career['whatsapp'] }}" target="_blank">{{ $career['whatsapp'] }}</a>
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
    </style>
@endpush

@push('css')
    <style>

    </style>
@endpush
