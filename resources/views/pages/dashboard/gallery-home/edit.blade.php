@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updategalleryhome', $galleries->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        @method('POST') <!-- Change from POST to PUT for updating -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Gallery Content</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Add Title</label>
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title', $galleries->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">Gallery Image</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <span class="text-success fw-bold">
                                    Image must be : {{ $image_size['image_width'] }}px X {{ $image_size['image_height'] }}px
                                </span>
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <!-- Display image if it exists -->
                                @if($galleries->image_name)
                                    <img src="{{ asset('public/assets/frontend/img/gallery/' . $galleries->image_name) }}" class="img-fluid" id="image_show"/>
                                    <p class="btn mb-0 w-100 text-left" id="img_description">Click the image to edit or update</p>
                                    <button type="button" class="btn btn-link text-danger" name="remove_image" id="remove_image">Remove Gallery image</button>
                                @else
                                    <p>No Gallery image uploaded yet.</p>
                                @endif
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                                <button type="button" class="btn btn-link" name="image_name" id="image_name">Set Gallery image</button>
                                @error('image_name')
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $galleries->status) ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="switch_publish">Update the Gallery Image</label>
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
                                <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', $galleries->order) }}" name="order" id="order">
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
        // Click on "Set Gallery Image"
        $("#image_name").click(function () {
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
                    $("#image_name").addClass("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove Image
        $("#remove_image").click(function () {
            $("#image_show").attr("src", "").addClass("d-none");
            $("#img_description, #remove_image").addClass("d-none");
            $("#image_name").removeClass("d-none");
            $("#file_input").val(""); // Clear file input
        });


    });
    </script>
@endpush
