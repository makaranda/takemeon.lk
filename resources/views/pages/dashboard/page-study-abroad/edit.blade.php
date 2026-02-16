@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updatestudyabroad', $page->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title', $page->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Short Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Short Description" name="sub_description" id="sub_description">{{ old('sub_description', $page->sub_description) }}</textarea>
                                @error('sub_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Description</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Description" name="description" id="description">{{ old('description', $page->description) }}</textarea>
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
                                <textarea rows="4" class="form-control mt-3" placeholder="SEO Keywords" name="seo_keywords" id="seo_keywords">{{ old('seo_keywords', $page->seo_keywords) }}</textarea>
                                @error('seo_keywords')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">SEO Description <span class="text-danger">{150-160 characters}</span></label>
                                <textarea rows="4" class="form-control mt-3" placeholder="SEO Description" name="seo_description" id="seo_description">{{ old('seo_description', $page->seo_description) }}</textarea>
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $page->status) ? 'checked' : '' }}/>
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
                                <label class="fw-bold">Parent</label>
                                <select class="form-select mt-3" placeholder="Select Parent" name="parent" id="parent">
                                    <option value="">None</option>
                                    @foreach ($pages as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent', $page->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                                    @endforeach
                                </select>
                                @error('parent')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Order</label>
                                <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', $page->order) }}" name="order" id="order">
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
                                @php
                                    if($page->feature_image && file_exists(public_path('assets/uploads/pages/' . $page->feature_image))){
                                        $img_class = '';
                                        $feature_image = $page->feature_image;

                                    }else{
                                        $img_class = 'd-none';
                                        $feature_image = '';
                                    }
                                @endphp
                                    <img src="{{ asset('public/assets/uploads/pages/' . $feature_image) }}" class="img-fluid {{ $img_class }}" id="image_show"/>
                                @if($page->feature_image)
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

                <div class="card mt-3">
                    <div class="card-header">Banner Image</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                @php
                                    if($page->banner_image && file_exists(public_path('assets/uploads/pages/' . $page->banner_image))){
                                        $img_class2 = '';
                                        $banner_image = $page->banner_image;

                                    }else{
                                        $img_class2 = 'd-none';
                                        $banner_image = '';
                                    }
                                @endphp
                                    <img src="{{ asset('public/assets/uploads/pages/' . $banner_image) }}" class="img-fluid {{ $img_class2 }}" id="image_show2"/>
                                <!-- Display image if it exists -->
                                @if($page->banner_image)
                                    <p class="btn mb-0" id="img_description2">Click the image to edit or update</p>
                                    <button type="button" class="btn btn-link text-danger" name="remove_image2" id="remove_image2">Remove Banner image</button>
                                @else
                                    <p>No Banner image uploaded yet.</p>
                                @endif
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <input type="file" name="file_input2" id="file_input2" accept="image/*" class="d-none">
                                <button type="button" class="btn btn-link" name="banner_image" id="banner_image">Set Banner image</button>
                                @error('banner_image')
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

        $("#banner_image").click(function () {
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
            let file2 = event.target.files[0];
            if (file2) {
                let reader2 = new FileReader();
                reader2.onload = function (e) {
                    $("#image_show2").attr("src", e.target.result).removeClass("d-none");
                    $("#img_description2, #remove_image2").removeClass("d-none");
                    $("#video_image").addClass("d-none");
                };
                reader2.readAsDataURL(file2);
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
            $("#banner_image").removeClass("d-none");
            $("#file_input2").val(""); // Clear file input
        });

    });
    </script>

<script>
    $(document).ready(function () {

    });

</script>
@endpush
