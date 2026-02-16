@extends('layouts.frontend')

@section('content')


   <!-- bradcam_area  -->
   <div class="bradcam_area breadcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Events</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ bradcam_area  -->

 <!-- ================ contact section start ================= -->
 <section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Events</h2>
        </div>
        <div class="col-lg-12">
            <div class="row justify-content-center">
              <div class="col-12 col-md-12 col-lg-12">
                @php
                    $no = 1;
                    $output = '';
                @endphp
                @if($galleries_group)
                     @foreach ($galleries_group as $key => $gallery)
                        @php
                            if(isset($no) && $no == 1){
								$show = 'show';
								$active = 'active';
							}else{
								$show = '';
								$active = '';
							}
							
							$output .='<li class="nav-item btn btn-outline-meroon pl-4 pr-4 hvr-float-shadow mb-2 mr-4 '.$active.'" style="font-size: 20px;border-radius: 30px; border-width: 3px;" role="presentation">
                    					<button type="button" class="nav-link bg-transparent border-0 '.$active.'" id="home-tab'.$no.'" data-bs-toggle="tab" data-bs-target="#according'.$no.'" role="tab" aria-controls="according'.$no.'" aria-selected="true" aria-expanded="true">'.$gallery->year.'</button>
                    				  </li>';
                    				  
                    		$no++;		  
                        @endphp
                     @endforeach
                @endif
                <div class="w-100 cat_lists mb-15">   
                    <ul class="nav nav-tabs justify-content-center pb-20" id="myTab" role="tablist">                                                   
                        {!! $output !!}
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    @php
                        $num = 1;
                        $output = '';
                    @endphp
                    @if($galleries_group)
                         @foreach ($galleries_group as $key => $gallery)
                            @php
                                if(isset($num) && $num == 1){
    								$shows = 'show';
    								$actives = 'active';
    							}else{
    								$shows = '';
    								$actives = '';
    							}
                        					  
                            @endphp
                            <div class="tab-pane fade {{ $shows }} {{ $actives }}" id="according{{ $num }}" role="tabpanel" aria-labelledby="home-tab{{ $num }}">
    					        <div class="row justify-content-center">
    					            @php
                                        $galleries_list = \App\Models\Gallery::where('status', 1)->where('year',$gallery->year)->get();
    					            @endphp
    					            @if ($galleries_list)
                                        @foreach ($galleries_list as $gallery)
                                            <div class="col-6 col-sm-4 col-md-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-12 programme_cat">
                                                        <a href="{{ route('frontend.events.singleview', $gallery->slug) }}" class="programme_cat_btn">
                                                            <h4 class="programme_cat_title">
                                                                {{ $gallery->title }}
                                                            </h4>
                                                            <img src="{{ url('public/assets/uploads/gallery/' . $gallery->feature_image) }}" alt="{{ $gallery->title }}" class="img-fluid hvr-grow cursor-pointer programme_cat_img" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
    					       </div>
    					   </div>
    					   @php
                        		$num++;
    					   @endphp
                         @endforeach
                    @endif
                    
                </div>
              </div>    
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

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
        .breadcam_bg_2{
            background-image: url('{{ asset('public/assets/frontend/img/banner/'.$events['banner_image']) }}') !important;
            background-size: cover;
            background-position: center;
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
    <script>
        $('.nav-item').on('click',function(){
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endpush
