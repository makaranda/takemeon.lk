@extends('layouts.app')

@section('content')



<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('admin.storemainslider') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Slider Content</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Top Text</label>
                                <input type="text" class="form-control mt-3" placeholder="Top Text" name="top_text" id="top_text" value="{{ old('top_text') }}">
                                @error('top_text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Heading</label>
                                <input type="text" class="form-control mt-3" placeholder="Heading" name="heading" id="heading" value="{{ old('heading') }}">
                                @error('heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Description</label>
                                <textarea class="form-control mt-3" placeholder="Sub Heading" name="description" id="description">{{ old('description') }}</textarea>
                                @error('sub_heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Slider Image</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                <img src="" class="img-fluid d-none" id="image_show"/>
                                <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove featured image</button>
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                                <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set Slider image</button>
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" checked/>
                                    <label class="form-check-label" for="switch_publish">Default switch to Publish Page</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="form-control btn btn-primary" type="submit" name="switch_submit" id="switch_submit">Publish</button>
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
    CKEDITOR.replace('description');


    $(document).ready(function () {
        // Click on "Set Featured Image"
        $("#feature_image").click(function () {
            $("#file_input").click(); // Open file input dialog
        });

        // When user selects an image
        $("#file_input").change(function (event) {
            console.log('updated');
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
@endpush
