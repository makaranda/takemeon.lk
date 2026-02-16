</main>

<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-bg footer-padding">
        <div class="container">
            <div class="row d-flex justify-content-between">

                <!-- About Us -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>About Us</h4>

                            <div class="footer-logo mb-20">
                                <a href="{{ route('home.index') }}">
                                    <img src="{{ url('public/assets/frontend/img/' . $settings['main_logo']) }}"
                                         alt="{{ $settings['website_name'] }}">
                                </a>
                            </div>

                            <div class="footer-pera">
                                <p>{{ $settings['footer_content'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Contact Info</h4>
                            <ul>
                                <li>
                                    <p>Address: {{ $settings['address'] ?? 'Colombo, Sri Lanka' }}</p>
                                </li>
                                <li>
                                    <a href="tel:{{ $settings['contact'] }}">
                                        Phone: {{ $settings['contact'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:{{ $settings['email'] }}">
                                        Email: {{ $settings['email'] }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Important Links -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Important Links</h4>
                            <ul>
                                <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('frontend.privacypolicy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                                <li><a href="{{ route('frontend.home.blogs') }}">Blogs</a></li>
                                <li><a href="{{ route('frontend.home.products') }}">Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Follow {{ $settings['website_name'] }}</h4>
                            <div class="footer-pera footer-pera2">
                                <ul>
                                    <li><a href="{{ $settings['social_facebook'] }}">Facebook</a></li>
                                    <li><a href="{{ $settings['social_linkedin'] }}">LinkedIn</a></li>
                                    <li><a href="{{ $settings['social_instagram'] }}">Instagram</a></li>
                                    <li><a href="{{ $settings['social_youtube'] }}">YouTube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Statistics Section -->
            <div class="row footer-wejed justify-content-between mt-4">

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-tittle-bottom">
                        <span>867+</span>
                        <p>Happy Customers</p>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>5000+</span>
                        <p>Products Sold</p>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>451</span>
                        <p>Blog Articles</p>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>568</span>
                        <p>Active Users</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom-area footer-bg">
        <div class="container">
            <div class="footer-border">
                <div class="row d-flex justify-content-between align-items-center">

                    <div class="col-xl-10 col-lg-10">
                        <div class="footer-copy-right">
                            <p>
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script>
                                {{ $settings['website_name'] }}. All rights reserved.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2">
                        <div class="footer-social f-right">
                            <a href="{{ $settings['social_facebook'] }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $settings['social_instagram'] }}"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $settings['social_linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{{ $settings['social_youtube'] }}"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#empty_cart').on('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to clear all items from the cart?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('frontend.cart.clear') }}",
                            type: "GET",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Cleared!',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Reload page or update cart section
                                        location.reload();
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong while clearing the cart.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>

        $(document).ready(function () {

        });

        // window.addEventListener('scroll', function () {
        //     const main_header = document.getElementById('main_header');
        //     const admin_navbar = document.getElementById('admin_navbar');
        //     if (window.scrollY > 50) {
        //         main_header.classList.add('scrolled');
        //     } else {
        //         main_header.classList.remove('scrolled');
        //     }
        // });

        fetchCartQty();

        function fetchCartQty() {
            $.ajax({
                url: "{{ route('frontend.fetchcartqty') }}",
                method: 'GET',
                success: function (response) {
                    // Assuming response contains the cart count
                    if (response.total_qty) {
                        updateCartBadge(response.total_qty);
                    } else {
                        updateCartBadge(0); // Default to 0 if no quantity is returned
                    }
                },
                error: function (xhr) {
                    console.error('Failed to fetch cart:', xhr);
                }
            });
        }

        // $(document).on('click', '.view_product', function(e) {
        //     e.preventDefault();

        //     let productId = $(this).data('id');
        //     let url = "{{ route('frontend.product.view', ':slug') }}".replace(':slug', productId);

        //     $.ajax({
        //         url: url,
        //         method: 'GET',
        //         success: function(response) {
        //             // Assuming response contains the product details
        //             // You can display the product details in a modal or redirect to the product page
        //             window.location.href = url;
        //         },
        //         error: function(xhr) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Error',
        //                 text: 'Failed to load product details',
        //                 timer: 1500,
        //                 showConfirmButton: false,
        //                 position: 'bottom-end'
        //             });
        //         }
        //     });
        // });


        $(document).on('click', '.view_product', function (e) {
            e.preventDefault();

            let productData = $(this).data('id').split('/');
            let productId = productData[0];
            let productCode = productData[1];

            $('#viewProductModelBody').html('<p>Loading...</p>');
            $('#viewProductModel').modal('show');

            $.ajax({
                url: 'products/view/' + productId + '/' + productCode,
                method: 'GET',
                success: function (response) {
                    console.log(response);
                    let html = `
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <img src="${response.feature_image}" class="img-fluid" alt="${response.title}">
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <h4>${response.title}</h4>
                                                                            <p><strong>Price:</strong> Rs ${response.price}</p>
                                                                            <p><strong>Available Qty:</strong> ${response.qty}</p>
                                                                            <p class="mb-0"><strong>Description:</strong></p>
                                                                            <div>${response.description}</div>
                                                                        </div>
                                                                    </div>`;
                    $('#viewProductModelBody').html(html);
                },
                error: function (xhr) {
                    $('#viewProductModelBody').html('<p class="text-danger">Product not found.</p>');
                }
            });
        });


        $(document).on('click', '.add_cart', function (e) {
            e.preventDefault();

            let productId = $(this).data('id');

            $.ajax({
                url: "{{ route('frontend.cart.add') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_info: productId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to cart',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false,
                            position: 'bottom-end'
                        });
                        fetchCarts();
                        // Update cart count dynamically
                        updateCartBadge(response.total_qty);
                    } else if (response.status === 'empty_user') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Login Required',
                            text: response.message,
                            showConfirmButton: true,
                            confirmButtonText: 'Login Now'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log("Redirecting to login page");
                                fetchCarts();
                                setTimeout(() => {
                                    window.location.href = "{{ route('frontend.userlogin') }}";
                                }, 1000);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false,
                            position: 'bottom-end'
                        });
                        fetchCarts();
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Failed to add to cart',
                        timer: 4500,
                        showConfirmButton: false,
                        position: 'bottom-end'
                    });
                }
            });
        });

        // Function to update cart badge
        function updateCartBadge(count) {
            // Ensure the .cart::after is updated
            let styleElement = document.getElementById("cart-badge-style");
            if (!styleElement) {
                styleElement = document.createElement("style");
                styleElement.id = "cart-badge-style";
                document.head.appendChild(styleElement);
            }

            styleElement.innerHTML = `
                                                                .header-area .header-mid .menu-wrapper .header-right .cart::after {
                                                                    content: "${count}";
                                                                }
                                                            `;
        }

        fetchCarts();
        // Function to cart carts
        function fetchCarts() {
            $.ajax({
                url: "{{ route('frontend.fetchcartdetails') }}",
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {

                    if (response) {
                        $('.menu-cart-details').html(response);
                    } else {
                        $('.menu-cart-details').html('<li><h6><b>Cart is Empty</b></h6></li>');
                    }
                }
            });
        }


    </script>
@endpush