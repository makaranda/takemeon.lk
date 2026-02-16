
<footer class="app-footer">
    <!--begin::To the end-->
    {{-- <div class="float-end d-none d-sm-inline">Anything you want</div> --}}
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
      Copyright &copy; {{ date('Y')}}&nbsp;
      <a href="https://amwebbers.com/" class="text-decoration-none">Admin Dashboard</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>


<div class="modal fade" id="alertModel" tabindex="-1" aria-labelledby="alertModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" id="frmAlertModel">
      @csrf
      <input type="hidden" name="alertPageId" id="alertPageId">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alertModelLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="alertModelBody">
        <p>Are you sure to delete this Page</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="alertModelBtnCalcel">Close</button>
        <button type="submit" class="btn btn-danger" id="alertModelBtnOk">Delete</button>
      </form>
      </div>
    </div>
  </div>
</div>

