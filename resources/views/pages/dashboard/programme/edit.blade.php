@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updateprogramme', $programme->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        @method('POST') <!-- Change from POST to PUT for updating -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Page Content</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Title</label>
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title', $programme->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Short Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Short Description" name="sub_description" id="sub_description">{{ old('sub_description', $programme->sub_description) }}</textarea>
                                @error('sub_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Description" name="description" id="description">{{ old('description', $programme->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                <textarea rows="4" class="form-control mt-3" placeholder="SEO Keywords" name="seo_keywords" id="seo_keywords">{{ old('seo_keywords', $programme->seo_keywords) }}</textarea>
                                @error('seo_keywords')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">SEO Description <span class="text-danger">{150-160 characters}</span></label>
                                <textarea rows="4" class="form-control mt-3" placeholder="SEO Description" name="seo_description" id="seo_description">{{ old('seo_description', $programme->seo_description) }}</textarea>
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
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $programme->status) ? 'checked' : '' }}/>
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
                                <label class="fw-bold">Country</label>
                                {{-- {{ var_dump($countries) }} --}}
                                <select class="form-select mt-3" placeholder="Select Country" name="country" id="country">
                                    @if($countries)
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['slug'] }}" {{ old('country') == $country['slug'] || $programme->country == $country['slug'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('parent')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Category</label>
                                {{-- {{ var_dump($categories) }} --}}
                                <select class="form-select mt-3" placeholder="Select Category" name="category" id="category">
                                    @if($categories)
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $category['id'] }}" data-id="{{ $category['id'] }}" {{ old('category') == $category['id']  || $programme->category == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                                            {{-- <option value="{{ $category['name'] }}" {{ old('category') == $category['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option> --}}
                                        @endforeach
                                    @endif
                                </select>
                                @error('parent')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <input type="hidden" name="old_subcategory" id="old_subcategory" value="{{ $programme->sub_category }}">
                                <input type="hidden" name="old_category" id="old_category" value="{{ $programme->category }}">
                                <label class="fw-bold">Select Programe</label>
                                <select class="form-select mt-3" name="subcategory" id="subcategories">
                                    <option value="">Select Program</option>
                                    {{-- Filled dynamically via JS --}}
                                </select>
                            </div>



                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Parent</label>
                                {{-- {{ var_dump($categories) }} --}}
                                <select class="form-select mt-3" placeholder="Select Parent" name="parent" id="parent">
                                    @if($programmes)
                                         <option value="0">Select Page</option>
                                        @foreach($programmes as $prog)
                                            @if($programme->id != $prog->id)
                                                <option value="{{ $prog->id }}" {{ $programme->parent == $prog->id ? 'selected' : '' }}>{{ $prog->title }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @error('parent')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Order</label>
                                <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', $programme->order) }}" name="order" id="order">
                                @error('order')
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
                                @if($programme->feature_image)
                                    <img src="{{ asset('public/assets/uploads/programmes/' . $programme->feature_image) }}" class="img-fluid" id="image_show"/>
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
                @if ($programme->slug == 'about-us')
                    <div class="card mt-3">
                        <div class="card-header">Video Thumbnail</div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-12 mt-3">
                                    <!-- Display image if it exists -->
                                    @if($programme->video_image)
                                        <img src="{{ asset('public/assets/frontend/img/about/' . $programme->video_image) }}" class="img-fluid" id="image_show2"/>
                                        <p class="btn mb-0" id="img_description2">Click the image to edit or update</p>
                                        <button type="button" class="btn btn-link text-danger" name="remove_image2" id="remove_image2">Remove Video image</button>
                                    @else
                                        <p>No Video image uploaded yet.</p>
                                    @endif
                                </div>

                                <div class="col-12 col-md-12 mt-3">
                                    <input type="file" name="file_input2" id="file_input2" accept="image/*" class="d-none">
                                    <button type="button" class="btn btn-link" name="video_image" id="video_image">Set Video image</button>
                                    @error('video_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
        selectCategory('');
        function selectCategory(categoryId=null){
            if (!categoryId){
                var categoryId = $('#old_category').val();
                var subCategoryId = $('#old_subcategory').val();
            }
            console.log('Selected Category ID : ',categoryId);
            let url = "{{ route('admin.getSubcategories', ':id') }}";
            url = url.replace(':id', categoryId);
            $.get(url, function (data) {
                $('#subcategories').empty();

                data.forEach(function (subCat) {
                    $('#subcategories').append(`<optgroup label="${subCat.name}">`);
                        if(subCategoryId == 0){
                            $('#subcategories').append(`<option value="0">Select Programme</option>`);
                        }
                    subCat.items.forEach(function (item) {
                        if(subCategoryId == item.id){
                            $('#subcategories').append(`<option value="${item.id}" selected>${item.name}</option>`);
                        }else{
                            $('#subcategories').append(`<option value="${item.id}">${item.name}</option>`);
                        }

                    });
                    $('#subcategories').append(`</optgroup>`);
                });
            });
        }

        $('#category').on('change', function () {
            var categoryId = $(this).val();
            selectCategory(categoryId);
        });
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
