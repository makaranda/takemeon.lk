@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <form action="{{ route('admin.saveuser') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        <div class="row">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">User Content</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12">
                          <label class="fw-bold">Name</label>
                          <input type="text" class="form-control mt-3" placeholder="Name" name="name" id="name" value="{{ old('name') }}">
                          @error('title')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Email</label>
                          <input type="text" class="form-control mt-3" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                          @error('email')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <!-- Phone -->
                       <div class="col-12 mt-3">
                            <label class="fw-bold">Phone</label>
                            <input type="number" class="form-control mt-2" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                       <div class="col-12 col-md-12 mt-3">
                          <label class="fw-bold">Username</label>
                          <input type="text" class="form-control mt-3" placeholder="Username" name="username" id="username" value="{{ old('username') }}">
                          @error('title')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                       <!-- Password -->
                       <div class="col-12 mt-3">
                            <label class="fw-bold">Password</label>
                            <input type="password" class="form-control mt-2" name="password" placeholder="Password">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-12 mt-3">
                            <label class="fw-bold">Confirm Password</label>
                            <input type="password" class="form-control mt-2" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
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
                        <label class="fw-bold">Role</label>
                        <select class="form-select mt-3" placeholder="Select Parent" name="role" id="role">
                           @if($user_role)
                                @foreach ($user_role as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                @endforeach
                           @endif
                        </select>
                        @error('role')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                </div>
             </div>
              {{-- <div class="card mt-3">
                  <div class="card-header">User Image</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                       <div class="col-12 col-md-12 mt-3">
                          <img src="" class="img-fluid d-none" id="image_show"/>
                          <p class="btn mb-0 d-none" id="img_description">Click the image to edit or update</p>
                          <button type="button" class="btn btn-link text-danger d-none" name="remove_image" id="remove_image">Remove User image</button>
                       </div>
                       <div class="col-12 col-md-12 mt-0">
                          <input type="file" name="file_input" id="file_input" accept="image/*" class="d-none">
                          <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set User image</button>
                          @error('feature_image')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                       </div>
                    </div>
                  </div>
               </div> --}}
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
@endpush
