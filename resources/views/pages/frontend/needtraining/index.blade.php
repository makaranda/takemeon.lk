@extends('layouts.frontend')

@section('content')



    <!-- Hero area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ url('public/assets/frontend/img/hero/about.jpg') }}">
            <div class="container">
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Need a Training</h2>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Need a Training</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Hero area End -->
    <section class="contact-section section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-lg-10">
                    <h2 class="contact-title">Need a Training</h2>
                </div>
                <div class="col-10 col-lg-10">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        img.img-fluid.login-logo {
            width: 120px !important;
        }

        .billing-title {
            color: rgb(81 72 17);
            text-transform: uppercase;
        }

        .border-box {
            padding: 15px;
            border 2px solid #f79b20;
        }

        .about_sub_description {
            p {}
        }

        .about_description {
            p {
                border: 2px solid #e6b127;
                padding: 24px 20px;
                display: inline-block;
                height: 100%;
                vertical-align: top;
            }
        }

        @media (max-width: 2040px) {
            .about_description {
                p {
                    width: 49%;
                    height: 260px;
                }
            }
        }

        @media (max-width: 1440px) {
            .about_description {
                p {
                    width: 49%;
                    height: 350px;
                }
            }
        }

        @media (max-width: 720px) {
            .about_description {
                p {
                    width: 100%;
                    height: auto;
                }
            }
        }

        @media (max-width: 540px) {
            .about_description {
                p {
                    width: 100%;
                    height: auto;
                }
            }
        }

        @media (max-width: 200px) {
            .about_description {
                p {
                    width: 100%;
                    height: auto;
                }
            }
        }
        table.fc-col-header{
            thead{
                tr{
                   border-bottom: 1px solid #ccc; 
                }
            }
        }
        .fc .fc-daygrid-day-frame {
            position: relative;
            min-height: 100%;
            align-content: center;
            border-bottom: 1px solid #ccc;
        }
        .fc .fc-daygrid-day-top {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-evenly;
        }
    </style>
@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
$(document).ready(function () {
    let isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    let getBookingsUrl = "{{ route('frontend.home.getbooking') }}";
    let saveBookingUrl = "{{ route('frontend.home.savebooking') }}";

    let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        selectable: true,
        events: getBookingsUrl,
        

        dayCellDidMount: function (info) {
            let day = info.date.getDay(); // 0 = Sunday, 6 = Saturday

            if (day === 0) {
                // Sunday → light red
                info.el.style.backgroundColor = '#ffe5e5';
            }

            if (day === 6) {
                // Saturday → light gray
                info.el.style.backgroundColor = '#f2f2f2';
            }
        },

        dateClick: function (info) {

            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Required',
                    text: 'Please login to book a training session.',
                    confirmButtonText: 'Login'
                }).then(() => {
                    window.location.href = '{{ route('frontend.userlogin') }}';
                });
                return;
            }

            let today = new Date().toISOString().split('T')[0];
            if (info.dateStr < today) {
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Error',
                    text: 'Cannot book past dates..!!'
                });
                return;
            }

            let body = `
                <div class="mb-2">
                    <label>Date</label>
                    <input type="date" name="training_date" class="form-control" value="${info.dateStr}" readonly>
                </div>

                <div class="mb-2">
                    <label>Start Time</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>End Time</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
            `;

            FormModelDetails(
                'Book Training Session',
                body,
                'Cancel',
                'Book Now',
                0,
                saveBookingUrl,
                'POST'
            );
        },

        eventClick: function (info) {
            let url = showBookingUrl.replace(':id', info.event.id);
            $.get(url, function (data) {

                let body = `
                    <p><b>Name:</b> ${data.user.name}</p>
                    <p><b>Date:</b> ${data.training_date}</p>
                    <p><b>Time:</b> ${data.start_time} - ${data.end_time}</p>
                    <p><b>Status:</b> ${data.status}</p>
                `;

                FormModelDetails('Booking Details', body, 'Close');
            });
        }
    });

    calendar.render();

});

            function FormModelDetails(title, body, cancel, ok = '', page_id = 0, action = null, method = 'POST') {
                $('#formModelLabel').text(title);
                $('#formModelBody').html(body);
                $('#formModelBtnCalcel').text(cancel);
                if (ok !== '') {
                    $('#formModelBtnOk').text(ok).show();
                } else {
                    $('#formModelBtnOk').hide();
                }
                $('#formPageId').val(page_id);
                $('#formModel form').attr('action', action);
                $('#formModel form').attr('method', method);
                console.log("Form Modal Open");
                var myFormModal = new bootstrap.Modal(document.getElementById('formModel'));
                myFormModal.show();
            }

$(document).on('submit', '#formModalRooute', function (e) {
    e.preventDefault();

    let form = $(this);

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),

        success: function () {

            $('#formModel').modal('hide');

            Swal.fire({
                icon: 'success',
                title: 'Booked Successfully'
            });

            location.reload();
        },

        error: function (err) {

            let msg = err.responseJSON?.error ?? 'Error occurred';

            Swal.fire({
                icon: 'error',
                title: msg
            });
        }
    });
});
</script>
@endpush