@extends('layouts.frontend')

@section('content')


<!-- Hero area Start-->

<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Blogs</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home.blogs') }}">Blogs</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $blog->title }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->

    <!-- Blog Area Start -->
    <section class="blog_area single-post-area section-padding">
<div class="container">
<div class="row">

<div class="col-lg-8 posts-list">

<div class="single-post">

<div class="feature-img">
<img class="img-fluid"
src="{{ asset('public/assets/uploads/blogs/'.$blog->feature_image) }}"
alt="{{ $blog->title }}">
</div>

<div class="blog_details">

<h2>{{ $blog->title }}</h2>

<ul class="blog-info-link mt-3 mb-4">

<li>
<i class="fa fa-user"></i>
{{ $blog->category?->name ?? 'General' }}
</li>

<li>
<i class="fa fa-calendar"></i>
{{ $blog->created_at->format('F d, Y') }}
</li>

</ul>

<p class="excert">
{{ $blog->sub_description }}
</p>

{!! $blog->description !!}

</div>

</div>


<div class="navigation-top">

<div class="d-sm-flex justify-content-between text-center">

<ul class="social-icons">

<li>
<a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
<i class="fab fa-facebook-f"></i>
</a>
</li>

<li>
<a href="https://twitter.com/share?url={{ url()->current() }}">
<i class="fab fa-twitter"></i>
</a>
</li>

<li>
<a href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}">
<i class="fab fa-linkedin"></i>
</a>
</li>

</ul>

</div>


<div class="navigation-area">
<div class="row">


{{-- Previous Blog --}}

@if($prev_blog)

<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">

<div class="thumb">
<a href="{{ route('frontend.blog.view',$prev_blog->slug) }}">
<img class="img-fluid"
src="{{ asset('public/assets/uploads/blogs/'.$prev_blog->feature_image) }}">
</a>
</div>

<div class="arrow">
<a href="{{ route('frontend.blog.view',$prev_blog->slug) }}">
<span class="lnr text-white ti-arrow-left"></span>
</a>
</div>

<div class="detials">
<p>Prev Post</p>

<a href="{{ route('frontend.blog.view',$prev_blog->slug) }}">
<h4>{{ $prev_blog->title }}</h4>
</a>

</div>

</div>

@endif



{{-- Next Blog --}}

@if($next_blog)

<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">

<div class="detials">
<p>Next Post</p>

<a href="{{ route('frontend.blog.view',$next_blog->slug) }}">
<h4>{{ $next_blog->title }}</h4>
</a>

</div>

<div class="arrow">
<a href="{{ route('frontend.blog.view',$next_blog->slug) }}">
<span class="lnr text-white ti-arrow-right"></span>
</a>
</div>

<div class="thumb">
<a href="{{ route('frontend.blog.view',$next_blog->slug) }}">
<img class="img-fluid"
src="{{ asset('public/uploads/blogs/'.$next_blog->feature_image) }}">
</a>
</div>

</div>

@endif


</div>
</div>

</div>

</div>



<div class="col-lg-4">

<div class="blog_right_sidebar">


{{-- Categories --}}

<aside class="single_sidebar_widget post_category_widget">

<h4 class="widget_title">Category</h4>

<ul class="list cat-list">

@foreach($categories as $index => $category)

<li class="category-item {{ $index >= 10 ? 'd-none' : '' }}">

<a href="{{ route('frontend.blog.category',$category->slug) }}" class="d-flex">

<p>{{ $category->name }}</p>

<p>({{ $category->blogs_count ?? 0 }})</p>

</a>

</li>

@endforeach

</ul>
@if($categories->count() > 10)
<div class="text-center mt-3">
<button id="readMoreBtn" class="btn btn-sm btn-info">Read More</button>
</div>
@endif

</aside>



{{-- Recent Posts --}}

<aside class="single_sidebar_widget popular_post_widget">

<h3 class="widget_title">Recent Post</h3>

@foreach($recent_blogs as $post)

<div class="media post_item">

<img src="{{ asset('public/uploads/blogs/'.$post->feature_image) }}"
alt="{{ $post->title }}">

<div class="media-body">

<a href="{{ route('frontend.blog.view',$post->slug) }}">
<h3>{{ $post->title }}</h3>
</a>

<p>{{ $post->created_at->format('F d, Y') }}</p>

</div>

</div>

@endforeach

</aside>



{{-- Tags --}}

<aside class="single_sidebar_widget tag_cloud_widget">

<h4 class="widget_title">Tag Clouds</h4>

<ul class="list">

@if($blog->tags)

@foreach(explode(',', $blog->tags) as $tag)

<li>
<a href="{{ route('frontend.blog.tag',trim($tag)) }}">
{{ trim($tag) }}
</a>
</li>

@endforeach

@endif

</ul>

</aside>


</div>

</div>


</div>
</div>
</section>
    <!-- Blog Area End -->

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

        .breadcam_bg_2 {
            background-image: url('{{ asset('public/assets/frontend/img/banner/' . $page_blog['banner_image']) }}') !important;
            background-size: cover;
            background-position: center;
        }

        .thumb {
            img {
                width: 60px;
                height: 60px;
                object-fit: cover;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        let itemsToShow = 10;
        let totalItems = $(".category-item").length;
        let currentlyVisible = 10;

        $("#readMoreBtn").click(function () {

            let hiddenItems = $(".category-item.d-none").slice(0, itemsToShow);

            hiddenItems.removeClass("d-none");

            currentlyVisible += itemsToShow;

            if (currentlyVisible >= totalItems) {
                $("#readMoreBtn").hide();
            }

        });
    </script>
@endpush