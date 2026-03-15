@extends('layouts.frontend')

@section('content')



<!-- Hero area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Error {{ $code ?? 'Error' }}</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Error {{ $code ?? 'Error' }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding error-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <img src="{{ asset('public/assets/images/error.svg') }}" alt="Error" class="error-image mb-4" />
                <h1 class="error-code display-2">{{ $code ?? 'Oops!' }}</h1>
                <h3 class="error-message mb-3">{{ $message ?? 'Something went wrong.' }}</h3>
                <p class="mb-4">The page you're looking for may have been moved, deleted, or is temporarily unavailable.</p>

                <ul class="list-unstyled error-list mb-4">
                    <li>✔ Check the spelling of the URL</li>
                    <li>✔ Return to the <a href="{{ url('/') }}">home page</a></li>
                    <li>✔ Use the back button</li>
                    <li>✔ Contact us if the issue persists</li>
                </ul>

                <a href="{{ url('/') }}" class="btn theme-btn">Go to Home</a>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

@endsection

@push('css')
<style>
    .error-page {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .error-code {
        color: #dc3545;
        font-weight: 700;
    }

    .error-message {
        font-size: 1.5rem;
        color: #343a40;
    }

    .error-list {
        padding-left: 0;
        font-size: 1rem;
        color: #6c757d;
    }

    .error-list li {
        margin-bottom: 8px;
    }

    .error-image {
        max-width: 200px;
    }

    .theme-btn {
        background-color: #0056b3;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
    }

    .theme-btn:hover {
        background-color: #003d80;
    }
</style>
@endpush
