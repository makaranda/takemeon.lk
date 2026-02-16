@extends('layouts.login')

@section('content')
{{-- {{ route('admin.authenticate') }} --}}
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ url('public/assets/login/images/bg-01.jpg') }}');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" action="{{ route('admin.login') }}" method="POST">
                <div class="text-center pb-3">
                    <img src="{{ url('public/assets/frontend/img/'. $settings['main_logo']) }}" alt="King Viking Logo" class="img-fluid main-logo"/>
                </div>
                <span class="login100-form-title billing-title p-b-10">
                    Admin Login
                </span>
                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div><i class="fa fa-ban mr-2"></i>Error</div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <p style="color: red;">{{ $error }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                {{-- @if (Session::has('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div><i class="fa fa-ban mr-2"></i>Error</div>
                            </div>
                            <div class="col-12 col-md-12">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif --}}
                @csrf
                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Type your username">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" id="password" placeholder="Type your password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                    <span class="rui-show-password-btn rui-show-password-btn--hidden" id="togglePassword">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" id="yui_3_17_2_1_1747552323924_20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12C19.25 13 17.5 18.25 12 18.25C6.5 18.25 4.75 13 4.75 12C4.75 11 6.5 5.75 12 5.75C17.5 5.75 19.25 11 19.25 12Z" id="yui_3_17_2_1_1747552323924_31"></path>
                            <circle cx="12" cy="12" r="2.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                        </svg>
                    </span>
                </div>

                {{-- <div class="text-right p-t-8 p-b-31">
                    <a href="#">
                        Forgot password?
                    </a>
                </div> --}}

                <div class="container-login100-form-btn mt-5">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>

                    </div>
                    <div class="wrap-login100-form-btn">

                        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">Bck to Main</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

@endsection

@push('css')
    <style>
        .text-center{
            text-align: center
        }
        img.img-fluid.login-logo{
            width: 120px !important;
        }
        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }
    .main-logo{
        width: 320px;
    }

    .btn-outline-secondary {
        color: #868e96;
        background-color: transparent;
        background-image: none;
        /* border-color: #868e96; */
        border: none;
        position: relative;
        z-index: 99999999;
        top: 10px;
        &:hover{
            background-color: transparent;
            border: none;
            color: #2b2b2c;
        }
    }
    </style>
@endpush
