@if ($products->count() > 0)
    @foreach($products as $product)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="properties pb-30">
                <div class="properties-card">
                    <div class="properties-img">
                        <a href="{{ route('frontend.product.view', $product->slug) }}">
                            <img src="{{ asset('public/assets/uploads/products/' . $product->feature_image) }}" alt="{{ $product->title }}"/>
                        </a>
                        <div class="socal_icon">
                            <a href="#" data-id="{{ $product->id.'/'.$product->product_code }}" class="add_cart"><i class="ti-shopping-cart"></i></a>
                            {{-- <a href="#"><i class="ti-heart"></i></a> --}}
                            <a href="#" data-id="{{ $product->id.'/'.$product->product_code }}" class="view_product"><i class="ti-zoom-in"></i></a>
                        </div>
                    </div>
                    <div class="properties-caption properties-caption2">
                        <h3><a href="{{ route('frontend.product.view', $product->slug) }}">{{ $product->title }}</a></h3>
                        <div class="properties-footer">
                            <div class="price">
                                @if ($product->discount > 0)
                                    <span class="discounted-price">Rs {{ $product->price - ($product->price * $product->discount / 100) }}
                                        <span class="original-price">Rs {{ $product->price }}</span>
                                    </span>
                                @else
                                    <span class="price">Rs {{ $product->price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            <strong>No products found!</strong>
        </div>
    </div>
@endif
