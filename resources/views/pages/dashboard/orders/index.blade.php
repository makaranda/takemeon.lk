@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <!-- Display success message -->
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
  <div class="card">
    <div class="card-header">Product Content</div>
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
                        <a href="{{ route('admin.createproduct') }}" id="add_blog" name="add_blog" class="btn btn-gray border float-right">Add Product</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <table id="pages_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="action_area">
                            <th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all" name="check_all"/></th>
                            <th class="tbl_col3">Order ID</th>
                            <th class="tbl_col3">Customer</th>
                            <th class="tbl_col3">Payment Method</th>
                            <th class="tbl_col3">Total Qty</th>
                            <th class="tbl_col3">Total Amount</th>
                            <th class="tbl_col3">Status</th>
                            <th class="tbl_col5">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders)
                            @foreach ($orders as $order)
                                <tr class="action_area">
                                    <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                                    <td>
                                        <span>{{ $order->id }}</span>
                                        <div class="btn_action_area">
                                            {{-- <a href="{{ route('admin.editorder',$order->id) }}" target="_self">Edit</a> --}}
                                            <a href="#" class="text-danger product_trash" data-id="{{ $order->id }}">Trash</a>
                                            <a href="#" class="order_view" data-id="{{ $order->id }}">View</a>
                                        </div>
                                    </td>
                                    <td>{{ $order->customer ? $order->customer->name : 'No Customer' }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td><span class="badge text-bg-primary text-capitalize">{{ $order->status }}</span></td>
                                    <td>
                                        <div class="publish_badge">orderd</div>
                                        <div class="date_time">{{ \Carbon\Carbon::parse($order->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="action_area">
                            <th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all_footer" name="check_all"/></th>
                            <th class="tbl_col3">Order ID</th>
                            <th class="tbl_col3">Customer</th>
                            <th class="tbl_col3">Payment Method</th>
                            <th class="tbl_col3">Total Qty</th>
                            <th class="tbl_col3">Total Amount</th>
                            <th class="tbl_col3">Status</th>
                            <th class="tbl_col5">Order Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>



<div class="modal fade" id="viewModel" tabindex="-1" aria-labelledby="viewModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModelLabel">Display Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewModelBody">
        <p>There are no anythings to display</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="viewModelBtnCalcel">Close</button>
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

    $('.order_view').on('click',function(){
        let order_id = $(this).data('id');
        console.log("Selected Order ID: ", order_id);
        var ajax_url = "{{ route('admin.fetchorderitems', ':id') }}";
        ajax_url = ajax_url.replace(':id', order_id);

        var myViewModal = new bootstrap.Modal(document.getElementById('viewModelBody'));

        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: ajax_url,
            method: 'GET',
            data: {
                _token: csrf_token // Include CSRF token in the data
            },
            success: function(response) {
                console.log(response);
               if(response.status == 1){
                 $('#viewModelBody').html(response.items);
               }else{
                 $('#viewModelBody').html('<h5>There are no any Order Items to display here</h5>');
               }
                myViewModal.show();
            },
            error: function(err) {
                $('#viewModelBody').html('<h5>Order Items Fetching Error</h5>');
                myViewModal.show();
                console.log(err);
            }
        });

    });

    $('.product_trash').on('click', function () {
        let product_id = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected product ID: ", product_id);

        var ajax_url = "{{ route('admin.deleteorder', ':id') }}";
        ajax_url = ajax_url.replace(':id', product_id);

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Deletion',
            'Are you sure you want to delete this Order?',
            'Cancel',
            'Delete',
            product_id,
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
            //$.redirect(""+ajax_url+"", {product_id: product_id}, "DELETE", "_self");

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
            //             title: 'product is deleted!',
            //             showConfirmButton: false,
            //             timer: 3500
            //         });
            //         // Optionally, you can remove the row from the table here.
            //         $('#product_row_' + product_id).remove(); // This is assuming each product has a row with an id `product_row_X`
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
