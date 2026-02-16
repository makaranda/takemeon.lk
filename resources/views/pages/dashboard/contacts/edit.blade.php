@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('admin.updatecontact', $contact->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        @method('PUT') <!-- Change from POST to PUT for updating -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contact Details</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <label class="fw-bold">Name</label>
                                <input type="text" class="form-control mt-3" placeholder="Add Title" name="name" id="name" value="{{ old('title', $contact->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Email</label>
                                <input type="text" class="form-control mt-3" placeholder="Email" name="email" id="email" value="{{ old('title', $contact->email) }}" readonly>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label class="fw-bold">Phone</label>
                                <input type="text" class="form-control mt-3" placeholder="Phone" name="phone" id="phone" value="{{ old('title', $contact->phone) }}" readonly>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label class="fw-bold">IP Address</label>
                                <input type="text" class="form-control mt-3" placeholder="IP Address" name="ip_address" id="ip_address" value="{{ old('title', $contact->ip_address) }}" readonly>
                                @error('ip_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label class="fw-bold">MAC Address</label>
                                <input type="text" class="form-control mt-3" placeholder="MAC Address" name="mac_address" id="mac_address" value="{{ old('title', $contact->mac_address) }}" readonly>
                                @error('mac_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label class="fw-bold">Device</label>
                                <input type="text" class="form-control mt-3" placeholder="Device" name="device" id="device" value="{{ old('title', $contact->device) }}" readonly>
                                @error('device')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-12 mt-3">
                                <label class="fw-bold">Message</label>
                                <textarea rows="4" class="form-control mt-3" placeholder="Message" name="message" id="message">{{ old('message', $contact->message) }}</textarea>
                                @error('message')
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
                                    <input class="form-check-input" type="checkbox" role="switch" name="switch_publish" id="switch_publish" {{ old('switch_publish', $contact->status) ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="switch_publish">Default switch to Publish Page</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="form-control btn btn-primary" type="submit" name="switch_submit" id="switch_submit">Update</button>
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
    
    });
    </script>
@endpush
