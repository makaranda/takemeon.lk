@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{ $gallery['title'] }}</h3>
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
          <h2 class="contact-title">{{ $gallery['title'] }}</h2>
        </div>
        <div class="col-lg-8">
          {!! $gallery['description'] !!}
        </div>
      </div>
      
      <div class="row">
          <div class="col-12 col-md-12">
              <div class="row justify-content-center tz-gallery">
                  @if($gallery_items)
                     @foreach($gallery_items as $key => $gallery_item)
                         <div class="col-6 col-sm-4 col-md-3">
                             <div class="card p-1 shadow hvr-grow">
                                 <a href="{{ url('public/assets/uploads/gallery-items/'.$gallery_item->feature_image) }}" class="lightbox">
                                     <img src="{{ url('public/assets/uploads/gallery-items/'.$gallery_item->feature_image) }}" class="img-fluid card-img-top hvr-grow" />
                                  </a>
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
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
        .breadcam_bg_2{
            background-image: url('{{ asset('public/assets/frontend/img/banner/'.$events['banner_image']) }}') !important;
            background-size: cover;
            background-position: center;
        }
        .gallery-container {
            background-color: #fff;
            color: #35373a;
            min-height: 100vh;
            padding: 30px 50px;
        }
        
        .gallery-container h1 {
            text-align: center;
            margin-top: 50px;
            font-family: 'Droid Sans', sans-serif;
            font-weight: bold;
        }
        
        .gallery-container p.page-description {
            text-align: center;
            margin: 25px auto;
            font-size: 18px;
            color: #999;
        }
        
        .tz-gallery {
            padding: 40px;
        }
        
        /* Override bootstrap column paddings */
        .tz-gallery .row > div {
            padding: 2px;
        }
        
        .tz-gallery .lightbox img {
            width: 100%;
            border-radius: 0;
            position: relative;
        }
        
        .tz-gallery .lightbox:before {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            color: #fff;
            font-size: 26px;
            font-family: "Font Awesome 6 Free";
            font-weight: 900; /* solid icons */
            content: "\f002"; /* search icon unicode */
            pointer-events: none;
            z-index: 9000;
            transition: 0.4s;
        }
        
        
        .tz-gallery .lightbox:after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            /*background-color: rgba(46, 132, 206, 0.7);*/
            background-color: rgba(0, 0, 0, 0.4);
            content: '';
            transition: 0.4s;
        }
        
        .tz-gallery .lightbox:hover:after,
        .tz-gallery .lightbox:hover:before {
            opacity: 1;
        }
        
        .baguetteBox-button {
            background-color: transparent !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
    
@endpush
