@extends('layouts.app')

@section('content')

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('admin.updatesettings', $setting->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Settings Content</div>
                  <div class="card-body">
                    <div class="row">
                       <div class="col-12">
                          <label class="fw-bold">Website Name</label>
                          <input type="text" class="form-control mt-3" name="website_name" id="website_name" value="{{ old('website_name', $setting->website_name) }}">
                          @error('website_name')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Website Title</label>
                          <input type="text" class="form-control mt-3" name="website_title" id="website_title" value="{{ old('website_title', $setting->website_title) }}">
                          @error('website_title')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Contact Number</label>
                          <input type="text" class="form-control mt-3" name="contact_number" id="contact_number" value="{{ old('contact_number', $setting->contact_number) }}">
                          @error('contact_number')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Email Address</label>
                          <input type="text" class="form-control mt-3" name="email_address" id="email_address" value="{{ old('email_address', $setting->email_address) }}">
                          @error('email_address')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Address</label>
                          <input type="text" class="form-control mt-3" name="address" id="address" value="{{ old('address', $setting->address) }}">
                          @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Google Map Link</label>
                          <textarea rows="6" class="form-control mt-3" name="google_map" id="google_map">{{ old('google_map', $setting->google_map) }}</textarea>
                          @error('google_map')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Footer Content</label>
                          <textarea rows="5" class="form-control mt-3" name="footer_content" id="footer_content">{{ old('footer_content', $setting->footer_content) }}</textarea>
                          @error('footer_content')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Special Offer <span class="text-danger">Discount</span></label>
                          <input type="text" class="form-control mt-3" name="special_offer" id="special_offer" value="{{ old('special_offer', $setting->special_offer) }}">
                          @error('special_offer')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                    </div>
                  </div>
               </div>

               <div class="card mt-3">
                <div class="card-header">Social Links</div>
                <div class="card-body">
                  <div class="row">
                     <div class="col-12 mt-3">
                        <label class="fw-bold">Facebook</label>
                        <input type="text" class="form-control mt-2" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $setting->social_facebook) }}">
                        @error('social_facebook')<div class="text-danger">{{ $message }}</div>@enderror
                     </div>
                     <div class="col-12 mt-3">
                        <label class="fw-bold">Linkedin</label>
                        <input type="text" class="form-control mt-2" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $setting->social_linkedin) }}">
                        @error('social_linkedin')<div class="text-danger">{{ $message }}</div>@enderror
                     </div>
                     <div class="col-12 mt-3">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" class="form-control mt-2" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $setting->social_instagram) }}">
                        @error('social_instagram')<div class="text-danger">{{ $message }}</div>@enderror
                     </div>
                     <div class="col-12 mt-3">
                        <label class="fw-bold">Youtube</label>
                        <input type="text" class="form-control mt-2" name="social_youtube" id="social_youtube" value="{{ old('social_youtube', $setting->social_youtube) }}">
                        @error('social_youtube')<div class="text-danger">{{ $message }}</div>@enderror
                     </div>
                  </div>
                </div>
             </div>

               <div class="card mt-3">
                <div class="card-header">SEO Content</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <label class="fw-bold">SEO Keywords <span class="text-danger">{10-15 highly relevant keywords}</span></label>
                            <textarea rows="4" class="form-control mt-3" placeholder="SEO Keywords" name="seo_keywords" id="seo_keywords">{{ old('seo_keywords', $setting->seo_keywords) }}</textarea>
                            @error('seo_keywords')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <label class="fw-bold">SEO Description <span class="text-danger">{150-160 characters}</span></label>
                            <textarea rows="4" class="form-control mt-3" placeholder="SEO Description" name="seo_description" id="seo_description">{{ old('seo_description', $setting->seo_description) }}</textarea>
                            @error('seo_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Publish</div>
                  <div class="card-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="switch_publish" id="switch_publish" {{ $setting->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_publish">Active Status</label>
                    </div>
                  </div>
                  <div class="card-footer">
                      <button class="form-control btn btn-primary" type="submit">Update</button>
                  </div>
               </div>

               <div class="card mt-3">
                <div class="card-header">Main Logo</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <!-- Display image if it exists -->
                            @if($setting->main_logo)
                                <img src="{{ asset('public/assets/frontend/img/' . $setting->main_logo) }}" class="img-fluid" id="image_show"/>
                                <p class="btn mb-0" id="img_description">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image" id="remove_image">Remove Main Logo</button>
                            @else
                                <p>No Main Logo uploaded yet.</p>
                            @endif
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                            <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set Main Logo</button>
                            @error('main_logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Footer Logo</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <!-- Display image if it exists -->
                            @if($setting->footer_logo)
                                <img src="{{ asset('public/assets/frontend/img/' . $setting->footer_logo) }}" class="img-fluid" id="image_show4"/>
                                <p class="btn mb-0" id="img_description4">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image4" id="remove_image4">Remove Footer Logo</button>
                            @else
                                <p>No Footer Logo uploaded yet.</p>
                            @endif
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <input type="file" name="file_input4" id="file_input4" accept="image/*" class="d-none">
                            <button type="button" class="btn btn-link" name="footer_image" id="footer_image">Set Footer Logo</button>
                            @error('footer_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Fevicon Logo</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <!-- Display image if it exists -->
                            @if($setting->fevicon_logo)
                                <img src="{{ asset('public/assets/frontend/img/' . $setting->fevicon_logo) }}" class="img-fluid" id="image_show2"/>
                                <p class="btn mb-0" id="img_description2">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image2" id="remove_image2">Remove Fevicon Logo</button>
                            @else
                                <p>No Fevicon Logo uploaded yet.</p>
                            @endif
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <input type="file" name="file_input2" id="file_input2" accept="image/*" class="d-none">
                            <button type="button" class="btn btn-link" name="fevicon_image" id="fevicon_image">Set Fevicon Logo</button>
                            @error('fevicon_logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Page Banner</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <!-- Display image if it exists -->
                            @if($setting->page_banner)
                                <img src="{{ asset('public/assets/frontend/img/banner/' . $setting->page_banner) }}" class="img-fluid" id="image_show3"/>
                                <p class="btn mb-0" id="img_description3">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image3" id="remove_image3">Remove Page Banner</button>
                            @else
                                <p>No Page Banner uploaded yet.</p>
                            @endif
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <input type="file" name="file_input3" id="file_input3" accept="image/*" class="d-none">
                            <button type="button" class="btn btn-link" name="page_banner_image" id="page_banner_image">Set Page Banner</button>
                            @error('page_banner_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </form>
</div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('scripts')
<script>
    // CKEDITOR.replace('short_description');
    // CKEDITOR.replace('description');

    $(document).ready(function () {
        // Click on "Set Featured Image"
        $("#feature_image").click(function () {
            $("#file_input").click(); // Open file input dialog
        });

        $("#fevicon_image").click(function () {
            $("#file_input2").click(); // Open file input dialog
        });

        $("#footer_image").click(function () {
            $("#file_input4").click(); // Open file input dialog
        });

        $("#page_banner_image").click(function () {
            $("#file_input3").click(); // Open file input dialog
        });

        // When user selects an image
        $("#file_input").change(function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#image_show").attr("src", e.target.result).removeClass("d-none");
                    $("#img_description, #remove_image").removeClass("d-none");
                    $("#feature_image").addClass("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // When user selects an image
        $("#file_input2").change(function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#image_show2").attr("src", e.target.result).removeClass("d-none");
                    $("#img_description2, #remove_image2").removeClass("d-none");
                    $("#fevicon_image").addClass("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // When user selects an image
        $("#file_input3").change(function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#image_show3").attr("src", e.target.result).removeClass("d-none");
                    $("#img_description3, #remove_image3").removeClass("d-none");
                    $("#page_banner_image").addClass("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // When user selects an image
        $("#file_input4").change(function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#image_show4").attr("src", e.target.result).removeClass("d-none");
                    $("#img_description4, #remove_image4").removeClass("d-none");
                    $("#footer_image").addClass("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove Image
        $("#remove_image").click(function () {
            $("#image_show").attr("src", "").addClass("d-none");
            $("#img_description, #remove_image").addClass("d-none");
            $("#feature_image").removeClass("d-none");
            $("#file_input").val(""); // Clear file input
        });

        // Remove Image
        $("#remove_image2").click(function () {
            $("#image_show2").attr("src", "").addClass("d-none");
            $("#img_description2, #remove_image2").addClass("d-none");
            $("#fevicon_image").removeClass("d-none");
            $("#file_input2").val(""); // Clear file input
        });

        // Remove Image
        $("#remove_image3").click(function () {
            $("#image_show3").attr("src", "").addClass("d-none");
            $("#img_description3, #remove_image3").addClass("d-none");
            $("#page_banner_image").removeClass("d-none");
            $("#file_input3").val(""); // Clear file input
        });

        // Remove Image
        $("#remove_image4").click(function () {
            $("#image_show4").attr("src", "").addClass("d-none");
            $("#img_description4, #remove_image4").addClass("d-none");
            $("#footer_image").removeClass("d-none");
            $("#file_input4").val(""); // Clear file input
        });

    });
    </script>
    <script>
        $('#track_type').on('change', function() {
                // Check if the selected value is not 'video'
                if($('#track_type').val() !== 'video') {
                    $('#browse_track_area').removeClass('d-none');
                    $('#video_track_area').addClass('d-none');
                    $('#track_type_capacity').text('{Maximum 10MB}');
                } else {
                    $('#browse_track_area').addClass('d-none');
                    $('#video_track_area').removeClass('d-none');
                    $('#track_type_capacity').text('');
                }
            });

            // Trigger the change event on page load to set the correct text
            $('#track_type').trigger('change');
        </script>

    <script>
        $(document).ready(function () {
            //console.log('File changed');
            $('#fileup').change(function () {
                // Get the file extension and check if it's valid
                console.log('File changed');
                var res = $('#fileup').val();
                var arr = res.split("\\");
                var filename = arr.slice(-1)[0];
                var fileExtension = filename.split(".");
                var fileExt = "." + fileExtension.slice(-1)[0];
                var validExtensions = [".mp3", ".wav"];

                if (validExtensions.indexOf(fileExt.toLowerCase()) === -1) {
                    // Show error icons and hide submit button if the file is invalid
                    $(".imgupload").hide("slow");
                    $(".imgupload.ok").hide("slow");
                    $(".imgupload.stop").show("slow");

                    $('#namefile').css({ "color": "red", "font-weight": 700 });
                    $('#namefile').html("File " + filename + " is not a valid image!");

                    $("#submitbtn").hide();
                    $("#fakebtn").show();
                } else {
                    // Show success icons and enable submit button if the file is valid
                    $(".imgupload").hide("slow");
                    $(".imgupload.stop").hide("slow");
                    $(".imgupload.ok").show("slow");

                    $('#namefile').css({ "color": "green", "font-weight": 700 });
                    $('#namefile').html(filename);

                    $("#submitbtn").show();
                    $("#fakebtn").hide();
                }
            });

            // Trigger file input click on custom button click
            $('#btnup').click(function () {
                $('#fileup').click();
            });
        });

    </script>
@endpush
