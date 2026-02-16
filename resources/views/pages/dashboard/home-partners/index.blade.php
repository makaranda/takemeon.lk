@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <!-- Display success message -->
    <div class="row">
        <div class="col-12 col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Page Content</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto col-md-auto">
                                    <select class="form-select" name="bulk_action" id="bulk_action">
                                        <option value="">Bulk Action</option>
                                        <option value="1">Move to Trash</option>
                                    </select>
                                </div>
                                <div class="col-auto col-md-auto">
                                    <button type="button" id="bulk_submit" name="bulk_submit" class="btn btn-light border">Apply</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('admin.createhomesecpartners') }}" id="add_partner" name="add_partner" class="btn btn-gray border float-right">Add Partner</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <table id="partners_list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="action_area">
                                        <th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all" name="check_all"/></th>
                                        <th class="tbl_col2">Title</th>
                                        <th class="tbl_col3">Image</th>
                                        <th class="tbl_col3">Order</th>
                                        <th class="tbl_col4"><i class="fa fa-comment"></i></th>
                                        <th class="tbl_col5">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($partners)
                                        @foreach ($partners as $partner)
                                            <tr class="action_area">
                                                <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                                                <td>
                                                    <span>{{ $partner->title }}</span>
                                                    <div class="btn_action_area">
                                                        <a href="{{ route('admin.edithomesecpartners',$partner->id) }}" target="_self">Edit</a>
                                                        <a href="#" class="text-danger partner_trash" data-id="{{ $partner->id }}">Trash</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($partner->image)
                                                        <img src="{{ url('public/assets/images/partner/'.$partner->image) }}" alt="Slider Image" class="img-fluid" style="width: 100px; height: auto;">
                                                    @else
                                                        <h6>There have No any Image</h6>
                                                    @endif
                                                </td>
                                                <td><span><input type="number" min="0" max="999" value="{{ $partner->order }}" class="order_change" data-id="{{ $partner->id.'/'.$partner->order }}"/></span></td>
                                                <td></td>
                                                <td>
                                                    <div class="publish_badge">Published</div>
                                                    <div class="date_time">{{ \Carbon\Carbon::parse($partner->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="action_area">
                                        <th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all_footer" name="check_all"/></th>
                                        <th class="tbl_col2">Title</th>
                                        <th class="tbl_col3">Image</th>
                                        <th class="tbl_col3">Order</th>
                                        <th class="tbl_col4"><i class="fa fa-comment"></i></th>
                                        <th class="tbl_col5">Date</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>
                        <div class="card-footer">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto col-md-auto">
                                    <select class="form-select" name="bulk_action" id="bulk_action">
                                        <option value="">Bulk Action</option>
                                        <option value="1">Move to Trash</option>
                                    </select>
                                </div>
                                <div class="col-auto col-md-auto">
                                    <button type="button" id="bulk_submit" name="bulk_submit" class="btn btn-light border">Apply</button>
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
  // Initialize DataTable after page load
  $(document).ready(function() {
      $('#partners_list').DataTable({
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
	$(document).ready(function() {
    // Select all checkboxes when clicking on "Select All" checkbox
    $('#check_all').on('click', function() {
      const isChecked = $(this).prop('checked');
	  $('#check_all_footer').prop('checked', isChecked);
      $('input[name="check_single"]').prop('checked', isChecked);
    });

	$('#check_all_footer').on('click', function() {
      const isChecked = $(this).prop('checked');
	  $('#check_all').prop('checked', isChecked);
      $('input[name="check_single"]').prop('checked', isChecked);
    });

    // Apply bulk action button functionality (optional)
    $('#bulk_submit').on('click', function() {
      const selectedAction = $('#bulk_action').val();
      const selectedItems = $('input[name="check_single"]:checked');

      if (selectedItems.length > 0 && selectedAction !== '') {
        // Handle bulk action (Move to Trash or other actions)
        alert(`Applying "${selectedAction}" to ${selectedItems.length} items.`);
      } else {
        alert('Please select items and choose an action.');
      }
    });

    $('.order_change').on('input',function(){
        let order_data = $(this).data('id'); // Use .data() instead of .attr()
        order_arr = order_data.split('/');
        let id = order_arr[0];
        let order_no = order_arr[1];
        let order_no_current = $(this).val();
        //console.log("Selected order ID: ", order_no, "ID : ",id, "order_no_current: ", order_no_current);

        var ajax_url = "{{ route('admin.updateOrderhomesecpartners', ':id') }}";
        ajax_url = ajax_url.replace(':id', id);
        ajax_url += `?order_no=${encodeURIComponent(order_no)}&order_no_current=${encodeURIComponent(order_no_current)}`;

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Update',
            'Are you sure you want to update this order no..?',
            'Cancel',
            'Update',
            id,
            ajax_url,
            'POST'
        );
    });

    $('.partner_trash').on('click', function () {
        let partner_id = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected partner ID: ", partner_id);

        var ajax_url = "{{ route('admin.deletehomesecpartners', ':id') }}";
        ajax_url = ajax_url.replace(':id', partner_id);

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Deletion',
            'Are you sure you want to delete this partner?',
            'Cancel',
            'Delete',
            partner_id,
            ajax_url,
            'POST'
        );

        // Ensure the delete confirmation button works correctly
        $('#alertModelBtnOk')
            .off('click') // Remove previous bindings to prevent duplicate event triggers
            .on('click', function () {
                if ($('#alertModel form input[name="_method"]').length === 0) {
                    $('#alertModel form').append('<input type="hidden" name="_method" value="DELETE">');
                }
                $('#alertModel form').submit();
            });
    });

        //$('#alertModelBtnOk').on('submit', function(e) {
            //e.preventDefault();
            //$.redirect(""+ajax_url+"", {partner_id: partner_id}, "DELETE", "_self");

            // var csrf_token = $('meta[name="csrf-token"]').attr('content');
            // $.ajax({
            //     url: ajax_url,
            //     method: 'DELETE',
            //     data: {
            //         _token: csrf_token // Include CSRF token in the data
            //     },
            //     success: function(response) {
            //         myModal.hide(); // Hide the modal
            //         Swal.fire({
            //             position: 'top-end',
            //             icon: 'success',
            //             title: 'partner is deleted!',
            //             showConfirmButton: false,
            //             timer: 3500
            //         });
            //         // Optionally, you can remove the row from the table here.
            //         $('#partner_row_' + partner_id).remove(); // This is assuming each partner has a row with an id `partner_row_X`
            //     },
            //     error: function(err) {
            //         myModal.hide(); // Hide the modal
            //         Swal.fire({
            //             position: 'top-end',
            //             icon: 'error',
            //             title: 'Something went wrong!',
            //             showConfirmButton: false,
            //             timer: 3500
            //         });
            //     }
            // });
        //});

  });
</script>
@endpush
