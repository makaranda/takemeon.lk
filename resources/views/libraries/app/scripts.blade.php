<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
></script>

<script
src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
crossorigin="anonymous"
></script>


<script
    src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
    crossorigin="anonymous"
></script>


{{-- <script src="https://cdn.jsdelivr.net/gh/mgalante/jquery.redirect@master/jquery.redirect.js"></script> --}}
<script src="{{ url('public/assets/app/vendor/ckeditor/ckeditor.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="{{ url('public/assets/app/js/adminlte.js') }}"></script>

<script>
  // Initialize DataTable after page load
  $(document).ready(function() {
      $('#pages_list').DataTable({
          "paging": true,
          "searching": true,
          "ordering": true,
          "info": false,
          "lengthChange": false,
          "pageLength": 20
      });
  });
</script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });

    function AlertModelDetails(title, body, cancel, ok, page_id = 0, action = null, method = 'POST') {
        $('#alertModelLabel').text(title);
        $('#alertModelBody').text(body);
        $('#alertModelBtnCalcel').text(cancel);
        $('#alertModelBtnOk').text(ok);
        $('#alertPageId').val(page_id);
        $('#alertModel form').attr('action', action);
        $('#alertModel form').attr('method', method);

        var myModal = new bootstrap.Modal(document.getElementById('alertModel'));
        myModal.show();
    }

    $('.logout_btn').on('click', function() {
        AlertModelDetails('Logout', 'Are you sure you want to logout this Admin?', 'Cancel', 'Logout', 0, '{{ route('admin.logout') }}', 'GET');
    });

    // $('.customer_logout_btn').on('click', function() {
    //     console.log('Click detected');
    //     AlertModelDetails('Logout', 'Are you sure you want to logout this customer?', 'Cancel', 'Logout', 0, '{{ route('admin.logout') }}', 'GET');
    // });
  </script>

