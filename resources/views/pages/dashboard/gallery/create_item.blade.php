@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.storeevent.items') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">
             
              <div class="card mt-3">
                  <div class="card-header">Gallery Images</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <div class="row" id="image_preview_area"></div> 
                          <img src="" class="img-fluid d-none" id="image_show"/>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove Gallery image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                          <input type="file" name="file_input[]" id="file_input" accept="image/*" class="d-none" multiple/>
                          <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set Gallery image</button>
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
              <div class="card mt-3">
                  <div class="card-header">Event Attributes</div>
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
                            <label class="fw-bold">Event Page</label>
                            <select class="form-select mt-3" placeholder="Select Event" name="event" id="event">
                          @foreach($pages as $key => $event)
                                <option value="{{ $event->id }}" {{ old('event') == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                          @endforeach
                            </select>
                          @error('event')
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

        let selectedImages = [];
        
        $("#feature_image").click(() => $("#file_input").click());
        
        $("#file_input").on("change", function (e) {
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
                error: function (err) {
                    console.error(err);
                    Swal.fire({
                      position: "bottom-end",
                      icon: "error",
                      title: "pload failed",
                      showConfirmButton: false,
                      timer: 1500
                    });
                }
            });
        });

    });
    
    
    </script>
@endpush
