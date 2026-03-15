@extends('layouts.frontend')

@section('content')



<!-- Hero area Start-->

<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Jobs List</h2>
                    </div>
                </div>
                <div class="col-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Jobs List</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Hero area End -->

<!-- listing Area Start -->
        <input type="hidden" id="initial_category" value="{{ $category->id ?? '' }}">
        <input type="hidden" id="initial_subcategory" value="{{ $subCategory->id ?? '' }}">
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!--? Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                    <div class="small-section-tittle2 mb-45">
                                    <div class="ion"> <svg 
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20px" height="12px">
                                    <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                        d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                    </svg>
                                    </div>
                                    <h4>Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <!-- select-Categories  -->
                                <div class="select-Categories pb-30">
                                    <div class="small-section-tittle2">
                                        <h4>Job Category</h4>
                                    </div>
                                    <!-- Select job items start -->
                                    <div class="select-job-items2">
                                        <select name="category" class="select" id="category">
                                            <option value="">Select Categories</option>
                                            @if($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('categories') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="small-section-tittle2">
                                        <h4>Job Sub Category</h4>
                                    </div>
                                    <div class="select-job-items2">
                                        <select name="sub_category" id="sub_category" class="select">
                                            <option value="">Select Sub Categories</option>
                                            @if($subCategories)
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}">
                                                    {{ $subCategory->name }}
                                                </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="small-section-tittle2">
                                        <h4>District</h4>
                                    </div>
                                    <div class="select-job-items2">
                                        <select name="district" id="district" class="select">
                                            <option value="">Select District</option>
                                            @if($districts)
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">
                                                    {{ $district->name }}
                                                </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="small-section-tittle2">
                                        <h4>Cities</h4>
                                    </div>
                                    <div class="select-job-items2">
                                        <select name="district_cities" id="district_cities" class="select">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- select-Categories End -->
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow mb-40">
                                    <div class="small-section-tittle2">
                                        <h4>Filter by Salary</h4>
                                    </div>
                                    <div class="widgets_inner">
                                        <div class="range_item">
                                            <input type="text" class="js-range-slider" value="" />
                                            <div class="d-flex align-items-center">

                                                <div class="price_value d-flex justify-content-center">
                                                    <input type="text" class="js-input-from" id="amount" name="amount" readonly />
                                                    <span>to</span>
                                                    <input type="text" class="js-input-to" id="amount" name="amount" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <!-- range end -->
                                <div class="select-Categories pb-20">
                                    <div class="small-section-tittle2 mb-20">
                                        <h4>Sort by Sex</h4>
                                    </div>

                                    <label class="container category-item">
                                        <input type="checkbox"
                                            id="sex_male"
                                            name="sex[]"
                                            value="male">
                                        <span class="checkmark"></span>
                                        Male
                                    </label>

                                    <label class="container category-item">
                                        <input type="checkbox"
                                            id="sex_female"
                                            name="sex[]"
                                            value="female">
                                        <span class="checkmark"></span>
                                        Female
                                    </label>
                                </div>

                                <!-- select-Categories start -->
                                <div class="select-Categories pb-20">
                                    <div class="small-section-tittle2 mb-20">
                                        <h4>Job Types</h4>
                                    </div>

                                    @if($categories)
                                        @foreach ($categories as $index => $category)
                                            <label class="container category-item {{ $index >= 10 ? 'd-none extra-category' : '' }}">
                                                {{ $category->name }}

                                                @if ($mainCategory)
                                                    <input type="checkbox"
                                                        id="cat{{ $category->id }}"
                                                        name="category_id[]"
                                                        value="{{ $category->id }}"
                                                        {{ $category->id == $mainCategory->id ? 'checked' : '' }}>
                                                @else
                                                    <input type="checkbox"
                                                        id="cat{{ $category->id }}"
                                                        name="category_id[]"
                                                        value="{{ $category->id }}"
                                                        {{ in_array($category->id, old('category_id', [])) ? 'checked' : '' }}>
                                                @endif

                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach

                                        @if(count($categories) > 10)
                                            <div class="text-center mt-2">
                                                <button type="button" id="readMoreBtn" class="btn btn-sm btn-info">
                                                    Read More
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <!-- select-Categories End -->


                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!--?  Right content -->
                    <div class="col-xl-9 col-lg-8 col-md-8">
                        <section class="featured-job-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            <span>{{ number_format($jobsCount) }} Jobs found</span>
                                            <!-- Select job items start -->
                                            <div class="select-job-items">
                                                <span>Sort by</span>
                                                <select name="select" style="display: none;" id="sort_by">
                                                    <option value="DESC">Date: Newest on top</option>
                                                    <option value="ASC">Date: Oldest on top</option>
                                                </select>
                                            </div>
                                            <!--  Select job items End-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="jobs_list">


                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- listing-area Area End -->

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            let itemsToShow = 10;
            let totalItems = $(".category-item").length;
            let currentlyVisible = 10;

            $("#readMoreBtn").click(function() {

                let hiddenItems = $(".category-item.d-none").slice(0, itemsToShow);
                hiddenItems.removeClass("d-none");
                currentlyVisible += itemsToShow;
                if (currentlyVisible >= totalItems) {
                    $("#readMoreBtn").hide();
                }
            });
            // $('#color').select2({
            //     templateResult: formatColor,
            //     templateSelection: formatColor,
            //     width: '100%'
            // });
            $('.form_dropdown').select2({
                width: '100%'
            });

            let initialCat = $('#initial_category').val();
            let initialSubCat = $('#initial_subcategory').val();

            if (initialCat) {
                $(`input[name="category_id[]"][value="${initialCat}"]`).prop('checked', true);
            }
            if (initialSubCat) {
                // Optional: if you're handling subcategories too
                $(`input[name="subcategory_id[]"][value="${initialSubCat}"]`).prop('checked', true);
            }

                // Initial load
            fetchJobs();
            // Re-fetch on filter change
            $('#size, #color, input[name="category_id[]"], input[name="brand_id[]"], #price_range').on('change', function() {
                fetchJobs();
            });

            $('#district, #district_cities').change(function(){
                fetchJobs();
            });

            $('input[name="sex[]"]').change(function(){
                console.log('SEX: '+$(this).val());
                fetchJobs();
            });

            $('input[name="category_id[]"]').change(function(){
                fetchJobs();
            });

            $('#sort_by').change(function(){
                fetchJobs();
            });

            function fetchJobs() {
                //console.log($('#initial_subcategory').val());
                $.ajax({
                    url: "{{ route('frontend.jobs.fetch') }}",
                    type: "GET",
                    data: {
                        district_id: $('#district').val(),
                        city_id: $('#district_cities').val(),
                        category_id: $('input[name="category_id[]"]:checked').map(function() { return this.value; }).get(),
                        brand_id: $('input[name="brand_id[]"]:checked').map(function() { return this.value; }).get(),
                        price_range: $('#price_range').val(),
                        sex: $('input[name="sex[]"]:checked').map(function(){
                            return this.value;
                        }).get(),
                        //subcategory_id: $('input[name="subcategory_id[]"]:checked').map(function() { return this.value; }).get()
                        subcategory_id: $('#initial_subcategory').val() || '',
                        sort_by: $('#sort_by').val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#jobs_list').html(data.html);
                    },
                    error: function(xhr, status, error) {
                        $('#jobs_list').html('<p>Error loading jobs.</p>');
                    }
                });
            }

            $('.select2').select2();

            $('#district').on('change', function(){
                let district_id = $(this).val();
                var url = "{{ route('get.cities', ':district_id') }}";
                url = url.replace(':district_id', district_id);
                console.log('URL: '+url);
                if(district_id){
                    $.ajax({
                        url: url,
                        type: "GET",
                        success:function(data){
                            $('#district_cities').html('<option value="">Select City</option>');
                            $.each(data, function(key,value){
                                $("#district_cities").append(
                                    '<option value="'+value.id+'">'+value.name+'</option>'
                                );
                            });
                            $('#district_cities').niceSelect('update');
                        }
                    });
                }else{
                    $('#district_cities').html('<option value="">Select City</option>');
                    $('#district_cities').niceSelect('update');
                }

            });


        });
    </script>
@endpush
