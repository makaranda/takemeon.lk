@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.storeproduct') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Product Content</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12">
                          <label class="fw-bold">Add Title</label>
                          <input type="text" class="form-control mt-3" placeholder="Add Title" name="title" id="title" value="{{ old('title') }}">
                          @error('title')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Short Description</label>
                          <textarea rows="4" class="form-control mt-3" placeholder="Short Description" name="sub_description" id="sub_description">{{ old('sub_description') }}</textarea>
                          @error('sub_description')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Description</label>
                          <textarea rows="4" class="form-control mt-3" placeholder="Description" name="description" id="description">{{ old('description') }}</textarea>
                          @error('description')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                    </div>
                </div>
               </div>


              <div class="card mt-3">
                  <div class="card-header">Gallery Images</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <div class="row" id="image_preview_area"></div>
                          <img src="" class="img-fluid d-none" id="image_show2"/>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image2">Remove Gallery image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                          <input type="file" name="file_input2[]" id="file_input2" accept="image/*" class="d-none" multiple/>
                          <button type="button" class="btn btn-link" name="feature_image2" id="feature_image2">Set Gallery image</button>
                          @error('feature_image')
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
                          <textarea rows="4" class="form-control mt-3" placeholder="SEO Keywords" name="seo_keywords" id="seo_keywords">{{ old('seo_keywords') }}</textarea>
                          @error('seo_keywords')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">SEO Description <span class="text-danger">{150-160 characters}</span></label>
                          <textarea rows="4" class="form-control mt-3" placeholder="SEO Description" name="seo_description" id="seo_description">{{ old('seo_description') }}</textarea>
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
              <div class="card mt-3">
                  <div class="card-header">Page Attributes</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Category</label>
                          <select class="form-select mt-3 form_dropdown" placeholder="Select Category" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                             @if($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                             @endif
                          </select>
                          @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Sub Category</label>
                          <select class="form-select mt-3 form_dropdown" placeholder="Select Sub Category" name="sub_category" id="sub_category">
                            <option value="">Select Sub Category</option>
                             {{-- @if($sub_categories)
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}" {{ old('sub_category') == $sub_category->id ? 'selected' : '' }}>{{ $sub_category->name }}</option>
                                @endforeach
                             @endif --}}
                          </select>
                          @error('sub_category')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Brand</label>
                          <select class="form-select mt-3 form_dropdown" placeholder="Select Brand" name="brand_id" id="brand_id">
                             @if($brands)
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                             @endif
                          </select>
                          @error('brand_id')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Size</label>
                          <select class="form-select mt-3 form_dropdown" placeholder="Select Size" name="size" id="size">
                             @if($sizes)
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" {{ old('size') == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                @endforeach
                             @endif
                          </select>
                          @error('size')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Color</label>
                          <select class="form-select mt-3" placeholder="Select Color" name="color" id="color">
                             @if($colors)
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" data-color="{{ $color->hex_code }}"
                                    {{ old('color') == $color->id ? 'selected' : '' }}>
                                    {{ $color->name }}
                                </option>
                                @endforeach
                             @endif
                          </select>
                          @error('color')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Price (Rs)</label>
                          <input type="number" class="form-control mt-3" min="1" placeholder="Price" value="{{ old('price', 1) }}" name="price" id="price">
                          @error('price')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Discount Rate (%)</label>
                          <input type="number" class="form-control mt-3" placeholder="Discount" value="{{ old('discount', 0) }}" name="discount" id="discount">
                          @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Qty</label>
                          <input type="number" class="form-control mt-3" min="1" placeholder="Qty" value="{{ old('qty', 1) }}" name="qty" id="qty">
                          @error('qty')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Order No</label>
                          <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', 0) }}" name="order" id="order">
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
                          <img src="" class="img-fluid d-none" id="image_show"/>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove featured image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .color_list {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    // CKEDITOR.replace('description');
    CKEDITOR.on('instanceReady', function() {
        CKEDITOR.instances.description.on('fileUploadRequest', function(evt) {
            var xhr = evt.data.fileLoader.xhr;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
        });
    });
    CKEDITOR.replace('sub_description');
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload') }}",
        filebrowserUploadMethod: 'form'
    });

    $(document).ready(function () {
        $('#color').select2({
            templateResult: formatColor,
            templateSelection: formatColor,
            width: '100%'
        });
        $('.form_dropdown').select2({
            width: '100%'
        });

        let selectedImages = [];

        $("#feature_image2").click(() => $("#file_input2").click());

        $("#file_input2").on("change", function (e) {
            const files = Array.from(e.target.files);
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgHTML = `
                        <div class="col-md-4 image-wrapper mt-2" data-index="${selectedImages.length}">
                            <img src="${e.target.result}" class="img-fluid border shadow card" />
                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-image w-100" data-index="${selectedImages.length}">Remove</button>
                        </div>`;
                    $("#image_preview_area").append(imgHTML);
                };
                reader.readAsDataURL(file);
                selectedImages.push(file);
            });

            // Clear the input so same file can be added again if removed
            this.value = "";
        });

        $(document).on("click", ".remove-image", function () {
            const index = $(this).data("index");
            selectedImages[index] = null; // Mark as null
            $(this).closest(".image-wrapper").remove();
        });


        $("#formSubmit").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            selectedImages.forEach((file, i) => {
                if (file) formData.append("images[]", file);
            });

            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    Swal.fire({
                      position: "bottom-end",
                      icon: "success",
                      title: "Images uploaded!",
                      showConfirmButton: false,
                      timer: 1500
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);

                },
                error: function (xhr, status, error) {
                    console.error(error);
                    console.error(status);
                    console.log("XHR Status:", xhr.status);
                    console.log("XHR Response:", xhr.responseText);
                    Swal.fire({
                      position: "bottom-end",
                      icon: "error",
                      title: "upload failed",
                      showConfirmButton: false,
                      timer: 1500
                    });
                }
            });
        });

        function formatColor (state) {
            if (!state.id) return state.text;
            var colorCode = $(state.element).data('color');
            var $state = $(
                '<span style="display: flex; align-items: center;">' +
                '<span style="display:inline-block; width:15px; height:15px; border-radius:50%; background-color:' + colorCode + '; margin-right: 8px;"></span>' +
                state.text +
                '</span>'
            );
            return $state;
        }

        $('#category_id').on('change', function () {
            var categoryID = $(this).val();
            $('#sub_category').html('<option value="">Loading...</option>');

            if (categoryID) {
                let token = $('meta[name="csrf-token"]').attr('content');
                let headers = {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                };
                let url = '{{ route("get.subcategories", ":id") }}';
                url = url.replace(':id', categoryID);
                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: headers,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        $('#sub_category').empty();
                        $('#sub_category').append('<option value="">Select Sub Category</option>');
                        $.each(data, function (key, value) {
                            $('#sub_category').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Error fetching subcategories.');
                        $('#sub_category').html('<option value="">Select Sub Category</option>');
                    }
                });
            } else {
                $('#sub_category').html('<option value="">Select Sub Category</option>');
            }
        });
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
@endpush
