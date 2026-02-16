@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('admin.updatehomesecpartners', $partner->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title', $partner->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Web Link</label>
                                <input type="text" class="form-control mt-3" placeholder="Web Link" name="web_link" id="web_link" value="{{ old('web_link', $partner->web_link) }}">
                                @error('web_link')
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
                                @if($partner->image)
                                    <img src="{{ asset('public/assets/images/partner/' . $partner->image) }}" class="img-fluid" id="image_show"/>
                                    <p class="btn mb-0 w-100 text-left" id="img_description">Click the image to edit or update</p>
                                    <button type="button" class="btn btn-link text-danger" name="remove_image" id="remove_image">Remove featured image</button>
                                @else
                                    <p>No featured image uploaded yet.</p>
                                @endif
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                                <button type="button" class="btn btn-link {{ $partner->image ? 'd-none' : '' }}" name="feature_image" id="feature_image">Set featured image</button>
                                @error('feature_image')
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $partner->status) ? 'checked' : '' }}/>
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
                                <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', $partner->order) }}" name="order" id="order">
                                @error('order')
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
