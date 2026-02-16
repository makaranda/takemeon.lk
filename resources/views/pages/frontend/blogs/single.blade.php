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
                                <h2>{{ $blog['title'] }}</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                                        <li class="breadcrumb-item"><a href="#">{{ $blog['title'] }}</a></li>
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

    <!-- Blog Area Start -->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Content -->
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img src="{{ url('public/assets/uploads/blogs/' . $blog->feature_image) }}"
                                alt="{{ $blog->title }}" class="border shadow-lg img-fluid" />
                        </div>
                        <div class="blog_details">
                            <h2 style="color: #2d2d2d;">{{ $blog->title }}</h2>
                            <p class="excert">{!! $blog->description !!}</p>
                            @if (!empty($blog->sub_description))
                                <div class="quote-wrapper">
                                    <div class="quotes">{!! $blog->sub_description !!}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @php
                        $shareUrl = urlencode(route('frontend.blogs.article.view', $blog->slug));
                        $shareTitle = urlencode($blog->title);
                    @endphp
                    <!-- Social Navigation -->
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            {{-- <p class="like-info">
                                <span class="align-middle"><i class="fa fa-heart"></i></span>
                                Lily and 4 people like this
                            </p> --}}
                            <ul class="social-icons">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                        title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                                        target="_blank" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
                                        target="_blank" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}"
                                        target="_blank" title="Share on WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Blog Navigation Area -->
                    <div class="navigation-area">
                        <div class="row">
                            <!-- Previous Post -->
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center"">
                                                @if ($prev_blog)
                                                                                                                                    <div class="
                                                        thumb">
                                                        <a href="{{ route('frontend.blogs.article.view', $prev_blog->slug) }}">
                                                            <img class="img-fluid"
                                                                src="{{ $prev_blog->feature_image ? url('public/assets/uploads/blogs/' . $prev_blog->feature_image) : asset('assets/img/post/preview.jpg') }}"
                                                                alt="{{ $prev_blog->title }}" />
                                                        </a>
                                                    </div>
                                                    <div class="arrow">
                                                        <a href="{{ route('frontend.blogs.article.view', $prev_blog->slug) }}">
                                                            <span class="lnr text-white ti-arrow-left"></span>
                                                        </a>
                                                    </div>
                                                    <div class="detials ml-3">
                                                        <p>Prev Post</p>
                                                        <a href="{{ route('frontend.blogs.article.view', $prev_blog->slug) }}">
                                                            <h4 style="color: #2d2d2d;">{{ Str::limit($prev_blog->title, 40) }}</h4>
                                                        </a>
                                                    </div>
                                                @endif
                        </div>

                        <!-- Next Post -->
                        <div
                            class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                            @if ($next_blog)
                                <div class="detials text-right mr-3">
                                    <p>Next Post</p>
                                    <a href="{{ route('frontend.blogs.article.view', $next_blog->slug) }}">
                                        <h4 style="color: #2d2d2d;">{{ Str::limit($next_blog->title, 40) }}</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="{{ route('frontend.blogs.article.view', $next_blog->slug) }}">
                                        <span class="lnr text-white ti-arrow-right"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="{{ route('frontend.blogs.article.view', $next_blog->slug) }}">
                                        <img class="img-fluid"
                                            src="{{ $next_blog->feature_image ? url('public/assets/uploads/blogs/' . $next_blog->feature_image) : asset('assets/img/post/next.jpg') }}"
                                            alt="{{ $next_blog->title }}" />
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- Author Info -->
                @if ($blog->author)
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{ $blog->author->profile_picture ?? asset('assets/img/blog/author.png') }}"
                                alt="{{ $blog->author->name }}">
                            <div class="media-body ml-3">
                                <a href="#">
                                    <h4>{{ $blog->author->name }}</h4>
                                </a>
                                <p>{{ $blog->author->bio ?? 'No biography available.' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- Search -->
                    {{-- <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Keyword">
                                    <div class="input-group-append">
                                        <button class="boxed-btn2" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </aside> --}}

                    <!-- Recent Posts -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title" style="color: #2d2d2d;">Recent Post</h3>
                        @if (!empty($recent_blogs) && $recent_blogs->count())
                            @foreach ($recent_blogs as $recent_blog)
                                @php
                                    $createdAt = \Carbon\Carbon::parse($recent_blog->created_at);
                                @endphp
                                <div class="media post_item">
                                    <img src="{{ $recent_blog->feature_image ? url('public/assets/uploads/blogs/' . $recent_blog->feature_image) : url('public/assets/images/default-blog.jpg') }}"
                                        alt="{{ $recent_blog->title }}" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="media-body ml-3">
                                        <a href="{{ route('frontend.blogs.article.view', $recent_blog->slug) }}">
                                            <h3 style="color: #2d2d2d;">{{ $recent_blog->title }}</h3>
                                        </a>
                                        <p>
                                            @if ($createdAt->isToday())
                                                {{ $createdAt->diffForHumans() }} {{-- e.g. "2 hours ago" --}}
                                            @else
                                                {{ $createdAt->format('F j, Y') }} {{-- e.g. "June 28, 2025" --}}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No recent posts found.</p>
                        @endif
                    </aside>

                    <!-- Newsletter -->
                    {{-- <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title" style="color: #2d2d2d;">Newsletter</h4>
                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Subscribe</button>
                        </form>
                    </aside> --}}
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

@push('css')
    <style>

    </style>
@endpush