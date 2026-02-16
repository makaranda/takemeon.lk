@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.storecareer') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Career Content</div>
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
                          <label class="fw-bold">Order</label>
                          <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', 0) }}" name="order" id="order">
                          @error('order')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Email Address</label>
                          <input type="text" class="form-control mt-3" placeholder="Email" value="{{ old('email', '') }}" name="email" id="email">
                          @error('email')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Whatsapp</label>
                          <input type="number" class="form-control mt-3" placeholder="94771234567" value="{{ old('whatsapp', '') }}" name="whatsapp" id="whatsapp">
                          @error('whatsapp')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Closing Date</label>
                          <input type="date" class="form-control mt-3" placeholder="{{ date('Y-m-d') }}" value="{{ old('closing_date', date('Y-m-d')) }}" name="closing_date" id="closing_date">
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
    <style>

    </style>
@endpush

@push('scripts')
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
