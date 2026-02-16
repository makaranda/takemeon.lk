@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updateupload', $upload->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload File</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 mt-3">
                                @if($upload->type == 'image' && $upload->file_name)
                                    <img src="{{ url('public/assets/uploads/pages/' . $upload->file_name) }}" class="img-fluid" id="image_show" />
                                @endif

                                <div id="file_preview" class="d-none"></div>
                                @if($upload->type != 'image' && $upload->file_name)
                                    <div id="file_preview2">
                                        @if($upload->type == 'document')
                                            @if(pathinfo($upload->file_name, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe src="{{ url('public/assets/uploads/pages/' . $upload->file_name) }}" width="100%" height="400px"></iframe>
                                            @else
                                                <p>📄 <a href="{{ url('public/assets/uploads/pages/' . $upload->file_name) }}" target="_blank">{{ $upload->file_name }}</a></p>
                                            @endif
                                        @elseif($upload->type == 'media')
                                            @if(in_array(pathinfo($upload->file_name, PATHINFO_EXTENSION), ['mp3', 'wav', 'ogg']))
                                                <audio controls width="250">
                                                    <source src="{{ url('public/assets/uploads/pages/' . $upload->file_name) }}" type="audio/{{ pathinfo($upload->file_name, PATHINFO_EXTENSION) }}">
                                                </audio>
                                            @else
                                                <video controls width="250">
                                                    <source src="{{ url('public/assets/uploads/pages/' . $upload->file_name) }}" type="video/{{ pathinfo($upload->file_name, PATHINFO_EXTENSION) }}">
                                                </video>
                                            @endif
                                        @endif
                                    </div>
                                @endif

                                <p class="btn mb-0" id="img_description">Click the image to edit or update</p>
                                <button type="button" class="btn btn-link text-danger" name="remove_image" id="remove_image">Remove Upload File</button>
                            </div>
                            <div class="col-12 col-md-12 mt-0">
                                <input type="file" name="file_input" id="file_input" class="d-none">
                                <button type="button" class="btn btn-link" name="feature_image" id="feature_image">Set Upload File</button>
                                @error('feature_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                @if ($upload->slug == 'about-us')
                    <div class="card mt-3">
                        <div class="card-header">Upload Video</div>
                        <div class="card-body">
                            <div class="col-md-12 mt-3">
                                @if(isset($upload->video))
                                    <label class="fw-bold w-100">Current Video</label>
                                    <video controls class="pt-3" width="100%">
                                        <source src="{{ asset('public/assets/uploads/videos/'.$upload->video) }}" type="video/mp4">
                                        Your browser does not support the video element.
                                    </video>
                                    <p class="text-danger"><span class="fw-bold">Existing File Name:</span> {{ $upload->video }}</p>
                                @endif

                                <label class="fw-bold text-left w-100 mt-3">Browse Video</label>
                                <div class="btn-container border mt-2">
                                    <h1 class="imgupload"><i class="fa fa-file-video-o"></i></h1>
                                    <p id="namefile">Only videos allowed! (.mp4, .mpeg, .webm)</p>
                                    <button type="button" id="btnup" class="btn btn-primary btn-lg">Browse for your Video!</button>
                                    <input type="file" name="fileup" id="fileup" accept=".mp4,.mpeg,.webm" hidden>
                                </div>

                                @error('fileup')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Publish</div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="switch_publish" id="switch_publish" {{ $upload->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="switch_publish">Default switch to Publish Page</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="form-control btn btn-primary" type="submit">Update</button>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Page Attributes</div>
                    <div class="card-body">
                        <label class="fw-bold">Type</label>
                        <select class="form-select mt-3" name="type" id="type">
                            <option value="image" {{ $upload->type == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="document" {{ $upload->type == 'document' ? 'selected' : '' }}>Document</option>
                            <option value="media" {{ $upload->type == 'media' ? 'selected' : '' }}>Media</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <label class="fw-bold mt-3">Order</label>
                        <input type="number" class="form-control mt-2" max="100" min="0" name="order" id="order" value="{{ old('order', $upload->order) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

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
                resetPreview();
            });

            $("#file_input").change(function (event) {
                const file = event.target.files[0];
                const type = $("#type").val();

                resetPreview();
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
                            previewHTML = `<audio controls width="250"><source src="${url}" type="audio/${ext}"></audio>`;
                        } else if (['mp4', 'webm'].includes(ext)) {
                            previewHTML = `<video controls width="250"><source src="${url}" type="video/${ext}"></video>`;
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
                    $("#file_preview2").addClass("d-none");
                    $("#remove_image").removeClass("d-none");
                    $("#feature_image").addClass("d-none");
                }
            });

            $("#remove_image").click(function () {
                resetPreview();
                $("#file_input").val("");
            });

            $("#btnup").click(function () {
                $("#fileup").click();
            });

            $("#fileup").change(function () {
                const filename = $(this).val().split("\\").pop();
                $("#namefile").text(filename);
            });
        });
    </script>
@endpush
