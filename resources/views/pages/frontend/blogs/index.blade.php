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
                            <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->


<!--================Blog Area =================-->
<section class="blog_area section-padding">
<div class="container">
<div class="row">

<div class="col-lg-8 mb-5 mb-lg-0">
    <div class="blog_left_sidebar">
        @if($blogs)
            @foreach($blogs as $blog)
                <article class="blog_item">
                    <div class="blog_item_img">
                        <img class="card-img rounded-0"
                        src="{{ asset('public/assets/uploads/blogs/'.$blog->feature_image) }}"
                        alt="{{ $blog->title }}">
                        <a href="#" class="blog_item_date">
                            <h3>{{ $blog->created_at->format('d') }}</h3>
                            <p>{{ $blog->created_at->format('M') }}</p>
                        </a>
                    </div>
                    <div class="blog_details">
                        <a class="d-inline-block"
                        href="{{ route('frontend.blog.view',$blog->slug) }}">
                            <h2>{{ $blog->title }}</h2>
                        </a>
                        <p>{{ $blog->sub_description }}</p>
                        <ul class="blog-info-link">
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    {{ $blog->category?->name ?? 'General' }}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-comments"></i>
                                    0 Comments
                                </a>
                            </li>
                        </ul>
                    </div>
                </article>
            @endforeach
        @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
    {{ $blogs->links() }}
    </div>

    </div>
</div>



<div class="col-lg-4">
<div class="blog_right_sidebar">

<!-- Category -->
<aside class="single_sidebar_widget post_category_widget">

<h4 class="widget_title">Category</h4>

<ul class="list cat-list">

@foreach($categories as $index => $category)

<li class="category-item {{ $index >= 10 ? 'd-none' : '' }}">

<a href="{{ route('frontend.blog.category',$category->slug) }}" class="d-flex">

<p>{{ $category->name }}</p>

<p>({{ $category->blogs()->count() }})</p>

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



<!-- Recent Posts -->
<aside class="single_sidebar_widget popular_post_widget">

<h3 class="widget_title">Recent Post</h3>

@foreach($recentPosts as $post)

<div class="media post_item">

<img src="{{ asset('public/assets/uploads/blogs/'.$post->feature_image) }}"
alt="{{ $post->title }}" class="recent_img">

<div class="media-body">

<a href="{{ route('frontend.blog.view',$post->slug) }}">

<h3>{{ $post->title }}</h3>

</a>

<p>{{ $post->created_at->format('F d, Y') }}</p>

</div>

</div>

@endforeach

</aside>



<!-- Tag Clouds -->
<aside class="single_sidebar_widget tag_cloud_widget">

<h4 class="widget_title">Tag Clouds</h4>

<ul class="list">

@foreach($blogs as $blog)

@if($blog->tags)

@foreach(explode(',', $blog->tags) as $tag)

<li>
<a href="{{ route('frontend.blog.tag',trim($tag)) }}">
{{ trim($tag) }}
</a>
</li>

@endforeach

@endif

@endforeach

</ul>

</aside>



</div>
</div>

</div>
</div>
</section>
<!--================Blog Area =================-->


@endsection

@push('css')
    <style>
        .recent_img{
            width: 100px;
        }
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
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
