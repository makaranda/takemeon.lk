@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <form action="{{ route('admin.savemusictrack') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Music Track Content</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12">
                          <label class="fw-bold">Add Title</label>
                          <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title">
                          @error('title')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Short Title</label>
                          <textarea rows="4" class="form-control mt-3" placeholder="Short Title" name="short_title" id="short_title"></textarea>
                          @error('short_title')
                           <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Spotify Link</label>
                          <textarea rows="4" class="form-control mt-3" placeholder="Spotify Link" name="link" id="link"></textarea>
                          @error('link')
                           <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                    </div>
                </div>
               </div>
              <div class="card mt-3">
                  <div class="card-header">Upload Track</div>
                  <div class="card-body">
                    <div class="row justify-content-start">
                       <div class="col-12 col-md-6">
                       <label class="fw-bold">Select Type <span id="track_type_capacity" class="text-danger">{Maximum 10MB}</span></label>
                       <select class="form-select mt-3" name="track_type" id="track_type">
                          <option value="audio">Audio</option>
                          <option value="video">Video</option>
                          <option value="beat">Beats</option>
                       </select>
                          @error('track_type')
                           <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <div class="center mt-3 d-none" id="video_track_area">
                              <div class="row">
                                  <div class="col-md-12 center">
                                      <label class="fw-bold w-100 text-left">Video Track URL</label>
                                      <input type="text" class="form-control mt-3" placeholder="Add Video Track YouTube URL" name="video_url" id="video_url">
                                  </div>
                              </div>
                              @error('video_url')
                              <div class="text-danger">{{ $message }}</div>
                             @enderror
                          </div>
                          <div class="center mt-3" id="browse_track_area">
                                  <label class="fw-bold text-left w-100">Browse Track</label>
                                  <div class="row mt-3">
                                      <div class="col-md-12 center">
                                          <div class="btn-container border">
                                              <!--the three icons: default, ok file (img), error file (not an img)-->
                                              <h1 class="imgupload"><i class="fa fa-file-image-o"></i></h1>
                                              <h1 class="imgupload ok"><i class="fa fa-check"></i></h1>
                                              <h1 class="imgupload stop"><i class="fa fa-times"></i></h1>
                                              <!--this field changes dinamically displaying the filename we are trying to upload-->
                                              <p id="namefile">Only pics allowed! (.mp3,.waw)</p>
                                              <!--our custom btn which which stays under the actual one-->
                                              <button type="button" id="btnup" class="btn btn-primary btn-lg">Browse for your Track!</button>
                                              <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                              <input type="file" value="" name="fileup" id="fileup" accept=".mp3,.wav">
                                          </div>
                                      </div>
                                  </div>
                                      <!--additional fields-->
                                  <!--<div class="row">
                                      <div class="col-md-12">
                                          <input type="submit" value="Submit!" class="btn btn-primary" id="submitbtn">
                                          <button type="button" class="btn btn-default" disabled="disabled" id="fakebtn">Submit! <i class="fa fa-minus-circle"></i></button>
                                      </div>
                                  </div>-->
                                @error('fileup')
                                   <div class="text-danger">{{ $message }}</div>
                                @enderror

                          </div>
                       </div>
                    </div>
                </div>
               </div>
          </div>
          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Publish</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" checked/>
                            <label class="form-check-label" for="switch_publish">Default switch to Publish Track</label>
                          </div>
                       </div>
                    </div>
                  </div>
                  <div class="card-footer">
                      <button class="form-control btn btn-primary" type="submit" name="switch_submit" id="switch_submit">Publish</button>
                  </div>
               </div>
              <div class="card mt-3">
                  <div class="card-header">Page Attributes</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Order</label>
                          <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="0" name="order" id="order">
                          @error('order')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Price</label>
                          <input type="number" class="form-control mt-3" value="1" min="1" placeholder="Price" name="price" id="price">
                          @error('price')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Qty</label>
                          <input type="number" class="form-control mt-3" value="1" min="1" placeholder="Qty" name="qty" id="qty">
                          @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                    </div>
                  </div>
               </div>
              <div class="card mt-3">
                  <div class="card-header">Feature Image</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12">
                            <span id="img_sizes" class="text-success">Image size : 290px x 290px</span>
                       </div> 
                       <div class="col-12 col-md-12 mt-3">
                          <img src="" class="img-fluid d-none" id="image_show"/>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove featured image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                          <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                          <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set featured image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                       @error('file_input')
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
    //CKEDITOR.replace('short_description');
    //CKEDITOR.replace('description');


    $(document).ready(function () {
        // Click on "Set Featured Image"
        $("#feature_image").click(function () {
            $("#file_input").click(); // Open file input dialog
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

        // Remove Image
        $("#remove_image").click(function () {
            $("#image_show").attr("src", "").addClass("d-none");
            $("#img_description, #remove_image").addClass("d-none");
            $("#feature_image").removeClass("d-none");
            $("#file_input").val(""); // Clear file input
        });


    });
    </script>
    <script>
        $('#track_type').on('change', function() {
             // Check if the selected value is not 'video'
             if($('#track_type').val() !== 'video') {
                 $('#img_sizes').text('Image size : 290px x 290px');
                 $('#browse_track_area').removeClass('d-none');
                 $('#video_track_area').addClass('d-none');
                 $('#track_type_capacity').text('{Maximum 10MB}');
             } else {
                 $('#img_sizes').text('Image size : 311px x 287px');
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
        $('#fileup').change(function () {
            // Get the file extension and check if it's valid
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
