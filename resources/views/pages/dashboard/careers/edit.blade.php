@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updatecareer', $career->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        @method('POST') <!-- Change from POST to PUT for updating -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Page Content</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Add Title</label>
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title', $career->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Short Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Short Description" name="sub_description" id="sub_description">{{ old('sub_description', $career->sub_description) }}</textarea>
                                @error('sub_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Description" name="description" id="description">{{ old('description', $career->description) }}</textarea>
                                @error('description')
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
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $career->status) ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="switch_publish">Default switch to Publish Page</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="form-control btn btn-primary" type="submit" name="switch_submit" id="switch_submit">Update</button>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Page Attributes</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Order</label>
                                <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', $career->order) }}" name="order" id="order">
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           <div class="col-12 col-md-12 mt-3">
                              <label class="fw-bold">Email Address</label>
                              <input type="text" class="form-control mt-3" placeholder="Email" value="{{ old('email', $career->email) }}" name="email" id="email">
                              @error('email')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-12 col-md-12 mt-3">
                              <label class="fw-bold">Whatsapp</label>
                              <input type="number" class="form-control mt-3" placeholder="94771234567" value="{{ old('whatsapp', $career->whatsapp) }}" name="whatsapp" id="whatsapp">
                              @error('whatsapp')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-12 col-md-12 mt-3">
                              <label class="fw-bold">Closing Date</label>
                              <input type="date" class="form-control mt-3" placeholder="{{ date('Y-m-d') }}" value="{{ old('closing_date', $career->closing_date ?? date('Y-m-d')) }}" name="closing_date" id="closing_date">
                              @error('closing_date')
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
                            <div class="col-12 col-md-12 mt-3">
                                <!-- Display image if it exists -->
                                @if($career->feature_image)
                                    <img src="{{ asset('public/assets/uploads/careers/' . $career->feature_image) }}" class="img-fluid" id="image_show"/>
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
    CKEDITOR.replace('sub_description');
    CKEDITOR.replace('description');


    $(document).ready(function () {
        // Click on "Set Featured Image"
        $("#feature_image").click(function () {
            $("#file_input").click(); // Open file input dialog
        });

        $("#video_image").click(function () {
            $("#file_input2").click(); // Open file input dialog
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
                    $("#video_image").addClass("d-none");
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
            $("#video_image").removeClass("d-none");
            $("#file_input2").val(""); // Clear file input
        });

    });
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
            var validExtensions = [".mp4", ".mpeg", ".webm"];

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
