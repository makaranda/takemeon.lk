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
                                <h2>Products</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Products</a></li>
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

<!-- listing Area Start -->
        <input type="hidden" id="initial_category" value="{{ $category->id ?? '' }}">
        <input type="hidden" id="initial_subcategory" value="{{ $subCategory->id ?? '' }}">
        <div class="listing-area pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <!--? Left content -->
                    <div class="col-xl-3 col-lg-4 col-md-4">
                        <!-- Job Category Listing start -->
                        <div class="category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <!-- select-Categories  -->
                                <div class="select-Categories pb-30">
                                    <div class="select-job-items2 mb-30">
                                        <div class="col-xl-12">
                                            <select name="size" id="size">
                                                <option value="">Select Size</option>
                                                @if($sizes)
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}" {{ old('size') == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="select-job-items2 mb-30">
                                        <div class="col-xl-12">
                                            <select name="color" id="color">
                                                <option value="">Select Color</option>
                                                @if($colors)
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}" data-color="{{ $color->hex_code }}"
                                                        {{ old('color') == $color->id ? 'selected' : '' }}>
                                                        {{ $color->name }}
                                                    </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- select-Categories End -->
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow mb-40">
                                    <div class="small-tittle">
                                        <h4>Filter by Price</h4>
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
                                <!-- select-Categories start -->
                                <div class="select-Categories pb-20">
                                    <div class="small-tittle mb-20">
                                        <h4>Filter by Category</h4>
                                    </div>
                                    @if($categories)
                                        @foreach ($categories as $category)
                                            <label class="container">{{ $category->name }}
                                                @if ($mainCategory)
                                                <input type="checkbox" id="cat{{ $category->id }}" name="category_id[]" value="{{ $category->id }}"
                                                    {{ (isset($category) && $category->id == $mainCategory->id) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                @else
                                                <input type="checkbox" id="cat{{ $category->id }}" name="category_id[]" value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('category_id', [])) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                @endif

                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- select-Categories End -->
                                <!-- select-Categories start -->
                                <div class="select-Categories pb-20">
                                    <div class="small-tittle mb-20">
                                        <h4>Filter by Brand</h4>
                                    </div>
                                    @if($brands)
                                        @foreach ($brands as $brand)
                                             <label class="container">{{ $brand->name }}
                                                <input type="checkbox" id="{{ $brand->id }}" name="brand_id[]" value="{{ $brand->id }}" {{ in_array($brand->id, old('brand_id', [])) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- select-Categories End -->
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!--?  Right content -->
                    <div class="col-xl-9 col-lg-8 col-md-8">
                        <div class="latest-items latest-items2">
                            <div class="row" id="products_list">


                            </div>
                        </div>
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
            fetchProducts();

            // Re-fetch on filter change
            $('#size, #color, input[name="category_id[]"], input[name="brand_id[]"], #price_range').on('change', function() {
                fetchProducts();
            });

            function fetchProducts() {
                console.log($('#initial_subcategory').val());
                $.ajax({
                    url: "{{ route('frontend.product.fetch') }}",
                    type: "GET",
                    data: {
                        size: $('#size').val(),
                        color: $('#color').val(),
                        category_id: $('input[name="category_id[]"]:checked').map(function() { return this.value; }).get(),
                        brand_id: $('input[name="brand_id[]"]:checked').map(function() { return this.value; }).get(),
                        price_range: $('#price_range').val(),
                        //subcategory_id: $('input[name="subcategory_id[]"]:checked').map(function() { return this.value; }).get()
                        subcategory_id: $('#initial_subcategory').val() || ''
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#products_list').html(data.html);
                    },
                    error: function(xhr, status, error) {
                        $('#products_list').html('<p>Error loading products.</p>');
                    }
                });
            }
        });
    </script>
@endpush
