@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Contact Details</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12">
                        <label class="fw-bold">Name</label>
                        <input type="text" class="form-control mt-3" placeholder="Add Title" name="name" id="name" value="{{ old('title', $contact->name) }}" readonly>
                    </div>
                    <div class="col-12 col-md-12 mt-3">
                        <label class="fw-bold">Email</label>
                        <input type="text" class="form-control mt-3" placeholder="Email" name="email" id="email" value="{{ old('title', $contact->email) }}" readonly>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label class="fw-bold">Phone</label>
                        <input type="text" class="form-control mt-3" placeholder="Phone" name="phone" id="phone" value="{{ old('title', $contact->phone) }}" readonly>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label class="fw-bold">IP Address</label>
                        <input type="text" class="form-control mt-3" placeholder="IP Address" name="ip_address" id="ip_address" value="{{ old('title', $contact->ip_address) }}" readonly>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label class="fw-bold">MAC Address</label>
                        <input type="text" class="form-control mt-3" placeholder="MAC Address" name="mac_address" id="mac_address" value="{{ old('title', $contact->mac_address) }}" readonly>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label class="fw-bold">Device</label>
                        <input type="text" class="form-control mt-3" placeholder="Device" name="device" id="device" value="{{ old('title', $contact->device) }}" readonly>
                    </div>

                    <div class="col-12 col-md-12 mt-3">
                        <label class="fw-bold">Message</label>
                        <textarea rows="4" class="form-control mt-3" placeholder="Message" name="message" id="message" readonly>{{ old('message', $contact->message) }}</textarea>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
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
