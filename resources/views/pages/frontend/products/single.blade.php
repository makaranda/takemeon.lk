@extends('layouts.frontend')

@section('content')


  <!-- Hero area Start-->
  <div class="hero-area section-bg2">
    <div class="container">
    <div class="row">
      <div class="col-xl-12">
      <div class="slider-area">
        <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
        <div class="hero-caption hero-caption2">
          <h2>{{ $product['title'] }}</h2>
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.home.products') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $product['title'] }}</a></li>
          </ol>
          </nav>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!--  Hero area End -->

  <!--  services-area start-->
  <div class="services-area2 pt-50">
    <div class="container">
    <div class="row">
      <div class="col-xl-12">
      <div class="row">
        <div class="col-xl-12">
        <!-- Single -->
        <div class="single-services d-flex align-items-center mb-0">
          <div class="features-img">
          @if (count($product->gallery) > 0)
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
          @foreach ($product->gallery as $proGallery)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img src="{{ asset('public/assets/uploads/product-items/' . $proGallery->feature_image) }}"
          class="d-block w-100" alt="{{ $product->title }}">
        </div>
        @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
          </button>
          </div>
      @else
        <img src="{{ asset('public/assets/uploads/products/' . $product->feature_image) }}"
        alt="{{ $product['title'] }}" />
      @endif
          </div>
          <div class="features-caption">
          <h3>The Rage of Dragons</h3>
          <p>By {{ $product->brand->name }}</p>
          <div class="price">
            <span>Rs {{ number_format($product->price, 2) }}</span>
          </div>
          <div class="review">
            {{-- <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            </div>
            <p>(120 Review)</p> --}}
          </div>
          <a href="#" data-id="{{ $product->id . '/' . $product->product_code }}"
            class="white-btn mr-10 add_cart">Add
            to Cart</a>
          @php
        $shareUrl = urlencode(url()->current());
        $shareTitle = urlencode($blog->title ?? 'Check this out');
        @endphp

          <div class="share-dropdown d-inline-block position-relative">
            <a href="#" class="border-btn share-btn">
            <i class="fas fa-share-alt"></i>
            </a>
            <div class="dropdown-share-menu shadow">
            <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
              target="_blank">
              <i class="fab fa-facebook-f text-primary"></i> Facebook
            </a>
            <a class="dropdown-item"
              href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
              target="_blank">
              <i class="fab fa-twitter text-info"></i> Twitter
            </a>
            <a class="dropdown-item" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
              target="_blank">
              <i class="fab fa-linkedin text-primary"></i> LinkedIn
            </a>
            <a class="dropdown-item"
              href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank">
              <i class="fab fa-whatsapp text-success"></i> WhatsApp
            </a>
            </div>
          </div>

          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- services-area End-->

  <!--Books review Start -->
  <section class="our-client section-padding best-selling">
    <div class="container">
    <div class="row">
      <div class="offset-xl-1 col-xl-10">
      <div class="nav-button f-left">
        <!--Nav Button  -->
        <nav>
        <div class="nav nav-tabs " id="nav-tab" role="tablist">
          <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one" role="tab"
          aria-controls="nav-one" aria-selected="true">Description</a>
          {{-- <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two" role="tab"
          aria-controls="nav-two" aria-selected="false">Author</a>
          <a class="nav-link" id="nav-three-tab" data-bs-toggle="tab" href="#nav-three" role="tab"
          aria-controls="nav-three" aria-selected="false">Comments</a>
          <a class="nav-link" id="nav-four-tab" data-bs-toggle="tab" href="#nav-four" role="tab"
          aria-controls="nav-four" aria-selected="false">Review</a> --}}
        </div>
        </nav>
        <!--End Nav Button  -->
      </div>
      </div>
    </div>
    </div>
    <div class="container">
    <!-- Nav Card -->
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
      <!-- Tab 1 -->
      <div class="row">
        <div class="offset-xl-1 col-lg-9">
        {!! $product['description'] !!}
        </div>
      </div>
      </div>

    </div>
    </div>
  </section>


  <!-- Books review End -->

  {{-- {{ var_dump($product->gallery) }} --}}

@endsection

@push('css')
  <style>
    img.img-fluid.login-logo {
    width: 120px !important;
    }

    .billing-title {
    color: rgb(81 72 17);
    text-transform: uppercase;
    }

    #carouselExampleAutoplaying {
    width: 400px;
    }

    .services-area2 .single-services {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    background-color: #6a0000;
    padding: 29px 20px 29px 80px;
    }

    .share-dropdown {
    position: relative;
    }

    .share-dropdown .dropdown-share-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 8px 0;
    display: none;
    min-width: 200px;
    z-index: 999;
    }

    .share-dropdown:hover .dropdown-share-menu {
    display: block;
    }

    .dropdown-share-menu .dropdown-item {
    display: flex;
    align-items: center;
    padding: 6px 15px;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
    }

    .dropdown-share-menu .dropdown-item i {
    margin-right: 8px;
    font-size: 16px;
    }

    .border-btn.share-btn {
    border: 1px solid #ccc;
    padding: 8px 12px;
    /* border-radius: 4px;
    background: #f9f9f9;
    color: #333; */
    cursor: pointer;
    }

    .border-btn.share-btn:hover {
    background: #eee;
    }
  </style>
@endpush

@push('css')
  <style>

  </style>
@endpush