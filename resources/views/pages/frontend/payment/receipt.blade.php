@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Payment Receipt</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

     <!-- about_area  -->
     <div class="about_area pb-5 mt-25">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-12">
                    <div class="about_info pl-0">
                        <h3>Payment Receipt</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                  <div class="card-body">
                    <ul>
                        @foreach($params as $key => $value)
                            <li><strong>{{ $key }}</strong>: {{ $value }}</li>
                        @endforeach
                    </ul>
                    <p><strong>Signature Verified:</strong> {{ $verified ? 'True' : 'False' }}</p>
                </div>
                </div>
            </div>
        </div>
    </div>



    <!-- gallery -->

    <!--/ gallery -->

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

        #number-container, #securityCode-container {
            height: 38px;
        }

        .flex-microform-focused {
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
    </style>
@endpush

@push('script')
    <script>

    </script>
@endpush
