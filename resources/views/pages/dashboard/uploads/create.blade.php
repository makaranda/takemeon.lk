@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.storeupload') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">

              <div class="card">
                  <div class="card-header">Upload File</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <img src="" class="img-fluid d-none" id="image_show"/>
                          <div id="file_preview" class="d-none"></div>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove Upload File</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                          <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                          <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set Upload File</button>
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
                  <div class="card-header">Page Attributes</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Type</label>
                          <select class="form-select mt-3" name="type" id="type">
                            <option value="image">Image</option>
                            <option value="document">Document</option>
                            <option value="media">Media</option>
                          </select>
                          @error('parent')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Order</label>
                          <input type="number" class="form-control mt-3" max="100" min="0" placeholder="Order" value="{{ old('order', 0) }}" name="order" id="order">
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
            function resetPreview() {
                $("#image_show").attr("src", "").addClass("d-none");
                $("#img_description, #remove_image").addClass("d-none");
                $("#file_preview").html('').addClass("d-none");
                $("#feature_image").removeClass("d-none");
            }

            function getExtension(fileName) {
                return fileName.split('.').pop().toLowerCase();
            }

            $("#feature_image").click(function () {
                $("#file_input").click();
            });

            $("#type").change(function () {
                let type = $(this).val();
                let accept = '';

                if (type === 'image') {
                    accept = 'image/*';
                } else if (type === 'document') {
                    accept = '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt';
                } else if (type === 'media') {
                    accept = 'audio/*,video/*,.mp3,.mp4,.wav,.ogg,.webm';
                }

                $('#file_input').attr('accept', accept);
                resetPreview(); // reset preview when type changes
            });

            $("#file_input").change(function (event) {
                const file = event.target.files[0];
                const type = $("#type").val();

                resetPreview(); // always reset first

                if (!file) return;

                const ext = getExtension(file.name);
                const url = URL.createObjectURL(file);

                if (type === 'image') {
                    console.log('Image Rendering');
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $("#image_show").attr("src", e.target.result).removeClass("d-none");
                        $("#img_description, #remove_image").removeClass("d-none");
                        $("#feature_image").addClass("d-none");
                    };
                    reader.readAsDataURL(file);
                } else {

                    console.log('Without Image Rendering');
                    let previewHTML = '';

                    if (type === 'media') {
                        if (['mp3', 'wav', 'ogg'].includes(ext)) {
                            previewHTML = `
                                <audio controls width="250">
                                    <source src="${url}" type="audio/${ext}">
                                    Your browser does not support the audio element.
                                </audio>`;
                        } else if (['mp4', 'webm'].includes(ext)) {
                            previewHTML = `
                                <video controls width="250">
                                    <source src="${url}" type="video/${ext}">
                                    Your browser does not support the video element.
                                </video>`;
                        } else {
                            previewHTML = `<p class="text-danger">Unsupported media format</p>`;
                        }
                    } else if (type === 'document') {
                        console.log('PDF Rendering');
                        if (ext === 'pdf') {
                            previewHTML = `<iframe src="${url}" width="100%" height="400px"></iframe>`;
                        } else {
                            previewHTML = `<p>📄 <a href="${url}" target="_blank">${file.name}</a></p>`;
                        }
                    }

                    $("#file_preview").html(previewHTML).removeClass("d-none");
                    $("#remove_image").removeClass("d-none");
                    $("#feature_image").addClass("d-none");
                }
            });

            $("#remove_image").click(function () {
                resetPreview();
                $("#file_input").val("");
            });
        });
    </script>
@endpush
