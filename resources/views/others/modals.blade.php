<!-- Form Modal -->
<div class="modal fade" id="formModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <form method="POST">
                <!-- Header -->
                <div class="modal-header text-left">
                    <img loading="lazy" src="{{ url('public/assets/frontend/img/logo/logo.png') }}" class="img-fluid" alt="logo">
                </div>

                <!-- Body -->
                <div class="modal-body text-center my-4">
                    <h5 id="formModelLabel" class="fw-bold mb-3 text-left"></h5>

                    <div id="formModelBody" class="text-left"></div>

                    <input type="hidden" id="formPageId" name="form_id">
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-end">

                    <button type="button"
                            id="formModelBtnCalcel"
                            class="btn head-btn2 px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            id="formModelBtnOk"
                            class="btn btn-primary">
                        OK
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

<!-- Alert Modal -->
<div class="modal fade" id="alertModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="alertModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST">
                <!-- Header -->
                <div class="modal-header text-center">
                    <img loading="lazy" src="{{ url('public/assets/frontend/img/logo/logo.png') }}" class="mx-auto" alt="logo">
                </div>

                <!-- Body -->
                <div class="modal-body text-center my-4">
                    <h5 id="alertModelLabel" class="fw-bold mb-3"></h5>

                    <div id="alertModelBody"></div>

                    <input type="hidden" id="alertPageId" name="page_id">
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-center">

                    <button type="button"
                            id="alertModelBtnCalcel"
                            class="btn head-btn2 px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            id="alertModelBtnOk"
                            class="btn btn-primary">
                        OK
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img loading="lazy" src="{{ url('public/assets/frontend/img/logo/logo.png') }}" class="mx-auto" alt="logo">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center col-12 my-4">
                        <h2 class="success-msg"><i class="fa-regular fa-circle-check"></i></h2>
                        <p class="success-msg fw-bolder" id="successMsg"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="course-data-bottom item-flex-center width-100">
                    <div class="btn-1 w-100">
                        <a data-bs-dismiss="modal" class="float-end" aria-label="Close" href="javascript:void(0)">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Warning Modal -->
<div class="modal fade" id="warningModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img loading="lazy" src="{{ url('public/assets/frontend/img/logo/logo.png') }}" class="mx-auto" alt="logo">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center col-12 my-4">
                        <h2 class="warning-msg"><i class="fa-solid fa-triangle-exclamation"></i></h2>
                        <p class="warning-msg fw-bolder" id="warningMsg"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="course-data-bottom item-flex-center width-100">
                    <div class="btn-1 w-100">
                        <a data-bs-dismiss="modal" class="float-end" aria-label="Close" href="javascript:void(0)">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img loading="lazy" src="{{ url('public/assets/frontend/img/logo/logo.png') }}" class="mx-auto" alt="logo">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center col-12 my-4">
                        <h2 class="error-msg"><i class="fa-regular fa-circle-xmark"></i></h2>
                        <p class="error-msg fw-bolder" id="errorMsg"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="course-data-bottom item-flex-center width-100">
                    <div class="btn-1 w-100">
                        <a data-bs-dismiss="modal" class="float-end" aria-label="Close" href="javascript:void(0)">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="waitingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="waitingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="waitingLoader">
            <div class="waitingLoader-container">
                <div class="waitingLoader-logo">
                    <img loading="lazy" src="public/assets/images/logo/preloader.png" alt="Preloader">
                </div>
            </div>
        </div>
    </div>
</div>