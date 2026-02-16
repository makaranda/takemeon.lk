@extends('layouts.frontend')

@section('content')

<!-- bradcam_area -->
<div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Checkout</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area -->

<!-- about_area -->
<div class="about_area pb-5 mt-25">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="card-body">
                    <div id="errors-output" role="alert"></div>

                    <form method="post" action="https://testsecureacceptance.cybersource.com/silent/pay" id="payment-form">
                        @csrf
                        @foreach($params as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <input type="submit" class="btn btn-primary mt-3" value="Submit Payment">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ about_area -->

@endsection

@push('css')
<style>
    img.img-fluid.login-logo {
        width: 120px !important;
    }

    .billing-title {
        color: rgb(81, 72, 17);
        text-transform: uppercase;
    }

    #number-container, #securityCode-container {
        height: 38px;
    }

    .flex-microform-focused {
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>
@endpush

@push('script')
<script>
    // You can add custom JS for client-side validation or tokenization here if needed
</script>
@endpush
