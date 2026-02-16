@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.updatemusictrack', $musicTrack->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Edit Music Track</div>
                  <div class="card-body">
                    <div class="row">
                       <div class="col-12">
                          <label class="fw-bold">Title</label>
                          <input type="text" class="form-control mt-3" name="title" id="title" value="{{ old('title', $musicTrack->title) }}">
                          @error('title')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Short Title</label>
                          <textarea rows="4" class="form-control mt-3" name="short_title" id="short_title">{{ old('short_title', $musicTrack->sub_title) }}</textarea>
                          @error('short_title')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-12 mt-3">
                          <label class="fw-bold">Spotify Link</label>
                          <textarea rows="4" class="form-control mt-3" name="link" id="link">{{ old('link', $musicTrack->link) }}</textarea>
                          @error('link')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                    </div>
                  </div>
               </div>
              <div class="card mt-3">
                  <div class="card-header">Upload Track</div>
                  <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                          <label class="fw-bold">Select Type</label>
                          <select class="form-select mt-3" name="track_type" id="track_type">
                              <option value="audio" {{ $musicTrack->type == 'audio' ? 'selected' : '' }}>Audio</option>
                              <option value="video" {{ $musicTrack->type == 'video' ? 'selected' : '' }}>Video</option>
                              <option value="beat" {{ $musicTrack->type == 'beat' ? 'selected' : '' }}>Beats</option>
                          </select>
                          @error('track_type')<div class="text-danger">{{ $message }}</div>@enderror
                       </div>
                       <div class="col-md-12 mt-3">
                          
                          @if(isset($musicTrack->track) && $musicTrack->type != 'video')
                            <label class="fw-bold w-100">Current Track</label>
                            <audio controls class="pt-3">
                                <source src="{{ url('public/assets/frontend/audios/'.$musicTrack->track) }}" type="audio/ogg">
                                <source src="{{ url('public/assets/frontend/audios/'.$musicTrack->track) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>
                            <p class="text-danger"><span class="fw-bold">Existing File Name:</span> {{ $musicTrack->track }}</p>
                          @endif
                          @error('fileup')<div class="text-danger">{{ $message }}</div>@enderror

                          <div class="center mt-3 d-none" id="video_track_area">
                            <div class="row">
                                <div class="col-md-12 center">
                                    <label class="fw-bold w-100 text-left">Video Track URL</label>
                                    <input type="text" class="form-control mt-3" placeholder="Add Video Track YouTube URL" name="video_url" value="{{ old('video_url', $musicTrack->track) }}" id="video_url">
                                </div>
                            </div>
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
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="switch_publish" id="switch_publish" {{ $musicTrack->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_publish">Publish Track</label>
                    </div>
                  </div>
                  <div class="card-footer">
                      <button class="form-control btn btn-primary" type="submit">Update</button>
                  </div>
               </div>
              <div class="card mt-3">
                  <div class="card-header">Page Attributes</div>
                  <div class="card-body">
                    <label class="fw-bold">Order</label>
                    <input type="number" class="form-control mt-3" name="order" id="order" value="{{ old('order', $musicTrack->order) }}">
                    @error('order')<div class="text-danger">{{ $message }}</div>@enderror
                    <label class="fw-bold mt-3">Price</label>
                    <input type="number" class="form-control mt-3" name="price" id="price" value="{{ old('price', $musicTrack->price) }}">
                    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                    <label class="fw-bold mt-3">Qty</label>
                    <input type="number" class="form-control mt-3" name="qty" id="qty" value="{{ old('qty', $musicTrack->qty) }}">
                    @error('qty')<div class="text-danger">{{ $message }}</div>@enderror
                  </div>
               </div>


               <div class="card mt-3">
                <div class="card-header">Feature Image</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 mt-3">
                            <div class="col-12 col-md-12">
                                 <span id="img_sizes" class="text-success">Image size : 290px x 290px</span>
                            </div> 
                            @php
                                $img_folder = ($musicTrack->type == 'video') ? 'video' : 'music_man';
                            @endphp
                            <!-- Display image if it exists -->
                            @if($musicTrack->track_image)
                                <img src="{{ asset('public/assets/frontend/img/'.$img_folder.'/' . $musicTrack->track_image) }}" class="img-fluid" id="image_show"/>
                                <p class="btn mb-0" id="img_description">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image" id="remove_image">Remove featured image</button>
                            @else
                                <p>No featured image uploaded yet.</p>
                            @endif
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                            <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set featured image</button>
                            @error('feature_image')
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
