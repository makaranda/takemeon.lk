<script type="application/javascript" src="{{ url('public/assets/frontend/js/swiper-bundle.min.js') }}"></script>
<script type="application/javascript" src="{{ url('public/assets/frontend/js/aos.js') }}"></script>

<!-- Slick-slider , Owl-Carousel ,slick-nav -->
<script src="{{ url('public/assets/frontend/js/slick.min.js') }}"></script>

<!-- All JS Custom Plugins Link Here here -->
<script src="{{ url('public/assets/frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ url('public/assets/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/bootstrap.min.js') }}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ url('public/assets/frontend/js/jquery.slicknav.min.js') }}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ url('public/assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/slick.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/price_rangs.js') }}"></script>

<!-- One Page, Animated-HeadLin -->
<script src="{{ url('public/assets/frontend/js/wow.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/animated.headline.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.magnific-popup.js') }}"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="{{ url('public/assets/frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.sticky.js') }}"></script>

<!-- contact js -->
<script src="{{ url('public/assets/frontend/js/contact.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.form.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/mail-script.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="{{ url('public/assets/frontend/js/plugins.js') }}"></script>
<script src="{{ url('public/assets/frontend/js/main.js') }}"></script>


<!-- Bootstrap 5.3 JS (Include before closing </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="{{ url('public/assets/frontend/js/main.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{ asset('build/assets/app.js') }}"></script> --}}



<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  const player = new Plyr('#video-source');
</script>

<script>
    function AlertModelDetails(title, body, cancel, ok, page_id = 0, action = null, method = 'POST') {
        $('#alertModelLabel').text(title);
        $('#alertModelBody').html(body);
        $('#alertModelBtnCalcel').text(cancel);
        $('#alertModelBtnOk').text(ok);
        $('#alertPageId').val(page_id);
        $('#alertModel form').attr('action', action);
        $('#alertModel form').attr('method', method);
        console.log("Alert Modal Open");
        var myModal = new bootstrap.Modal(document.getElementById('alertModel'));
        myModal.show();
    }

    $('#logout_btn').on('click', function() {
        AlertModelDetails('Logout', 'Are you sure you want to logout this Admin?', 'Cancel', 'Logout', 0, '{{ route('admin.logout') }}', 'GET');
    });

    $('#customer_logout_btn').on('click', function() {
        AlertModelDetails('Logout', 'Are you sure you want to logout this Customer?', 'Cancel', 'Logout', 0, '{{ route('frontend.userlogout') }}', 'GET');
    });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#forget_password_form').on('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to reset your password?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Enter your Username or Email',
                        input: 'text',
                        inputPlaceholder: 'name@example.com or username',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Send OTP',
                        showLoaderOnConfirm: true,
                        preConfirm: (loginInput) => {
                            return new Promise((resolve, reject) => {
                                $.ajax({
                                    url: '{{ route('frontend.userresetpassword') }}',
                                    type: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        formResetPwd: loginInput,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    }),
                                    success: function (response) {
                                        console.log(response);
                                        resolve(response); // this will go to result.value

                                    },
                                    error: function (xhr, status, error) {
                                        console.error('Error:', error);
                                        console.error('Response:', xhr.responseJSON);
                                        console.error('Status:', status);

                                        let errorMsg = xhr.responseJSON?.message || 'Server Error';
                                        Swal.showValidationMessage(errorMsg);
                                        //reject(new Error(errorMsg));
                                    }
                                });
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.status === 'otp_sent') {
                            // Show Bootstrap modal for OTP input
                            $('#alertModelLabel').text('Enter OTP');
                            $('#alertModelBody').html(`
                                <input type="hidden" id="otp_user_id" value="${result.value.user_id}">
                                <div class="mb-3">
                                    <label for="otp" class="form-label">OTP</label>
                                    <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
                                </div>
                            `);
                            // Set form attributes dynamically
                            $('#frmAlertModel').attr('action', '{{ route('frontend.verifyotp') }}');
                            $('#frmAlertModel').attr('method', 'POST');
                            $('#alertModelBtnCalcel').text('Cancel');

                            $('#alertModelBtnOk').text('Verify OTP');
                            $('#alertModel').modal('show');
                        }
                    })
                    .catch((err) => {
                        console.error('Swal preConfirm error:', err);
                    });
                }
            });
        });

        $('#frmAlertModel').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const url = form.attr('action');
            const method = form.attr('method');

            let otp = $('#otp').val() ?? '';
            let user_id = $('#otp_user_id').val() ?? '';
            console.log('lOGOUT : ',otp, user_id);
            $.ajax({
                url: url,
                method: method,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    otp: otp,
                    user_id: user_id
                },
                success: function (res) {
                    if (res.status === 'success') {
                        $('#alertModel').modal('hide');
                        Swal.fire('Success', res.message, 'success');
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('OTP Error:', error);
                    console.error('OTP Response:', xhr.responseJSON);
                    console.error('OTP Status:', status);

                    let errorMsg = xhr.responseJSON?.message || 'Server Error';
                    Swal.showValidationMessage(errorMsg);
                    //reject(new Error(errorMsg));
                }
            });
        });


    });
</script>
