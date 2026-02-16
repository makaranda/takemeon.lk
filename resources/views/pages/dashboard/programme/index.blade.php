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
    <div class="card-header">Programme Content</div>
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
                        <a href="{{ route('admin.createprogramme') }}" id="add_blog" name="add_blog" class="btn btn-gray border float-right">Add Programme</a>
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
					<th class="tbl_col2">Title</th>
					<th class="tbl_col3">Author</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
					<th class="tbl_col5">Order</th>
					<th class="tbl_col6">Parent</th>
					<th class="tbl_col5">Date</th>
				</tr>
			</thead>
			<tbody>

                @if($programmes)

                    @foreach ($programmes as $programme)
                        {{-- @if ($programme->parent == 0) --}}
                        <tr class="action_area bg-warning parent_class">
                            <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                            <td>
                                <span>{{ $programme->title }}</span>
                                <div class="btn_action_area">
                                    <a href="{{ route('admin.editprogramme',$programme->id) }}" target="_self">Edit</a>
                                    <a href="#" class="text-danger page_trash" data-id="{{ $programme->id }}">Trash</a>
                                    <a href="{{ url('programmes/'.$programme->slug) }}" target="_blank">View</a>
                                </div>
                            </td>
                            <td>{{ $programme->author ? $programme->author->name : 'No Author' }}</td>
                            <td></td>
                            <td><span><input type="number" min="0" max="999" value="{{ $programme->order }}" class="order_change" data-id="{{ $programme->id.'/'.$programme->order }}"/></span></td>
                            <td>
                                <select class="form-control selected_page" name="selected_page" data-id="{{ $programme->id.'/'.$programme->parent }}">
                                    <option value="0">Select Page</option>
                                     @foreach($programmes_list as $prog)
                                        @if($programme->id != $prog->id && $prog->parent == 0)
                                            <option value="{{ $prog->id }}" {{ $programme->parent == $prog->id ? 'selected' : '' }}>{{ $prog->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="publish_badge">Published</div>
                                <div class="date_time">{{ \Carbon\Carbon::parse($programme->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                            </td>
                        </tr>
                        @if (isset($children[$programme->id]))
                            @foreach ($children[$programme->id] as $child)
                                <tr class="action_area bg-warning parent_sub_class">
                                    <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                                    <td>
                                        <span class="pl-20">{{ $child->title }}</span>
                                        <div class="btn_action_area pl-20">
                                            <a href="{{ route('admin.editprogramme',$child->id) }}" target="_self">Edit</a>
                                            <a href="#" class="text-danger page_trash" data-id="{{ $child->id }}">Trash</a>
                                            <a href="{{ url('programmes/'.$child->slug) }}" target="_blank">View</a>
                                        </div>
                                    </td>
                                    <td>{{ $child->author ? $child->author->name : 'No Author' }}</td>
                                    <td></td>
                                    <td><span><input type="number" min="0" max="999" value="{{ $child->order }}" class="order_change" data-id="{{ $child->id.'/'.$child->order }}"/></span></td>
                                    <td>
                                        <select class="form-control selected_page" name="selected_page" data-id="{{ $child->id.'/'.$child->parent }}">
                                            <option value="0">Select Page {{ $child->parent }}</option>
                                            @foreach($programmes_list as $prog)
                                                {{-- @if($programme->id != $prog->id) --}}
                                                    <option value="{{ $prog->id }}" {{ $child->parent == $prog->id ? 'selected' : '' }}>{{ $prog->title }}</option>
                                                {{-- @endif --}}
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="publish_badge">Published</div>
                                        <div class="date_time">{{ \Carbon\Carbon::parse($child->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                                    </td>
                                </tr>
                                
                                @if(isset($children_subs[$child->id]))
                                     @foreach ($children_subs[$child->id] as $child_sub)
                                         <tr class="action_area bg-warning">
                                            <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                                            <td>
                                                <span class="pl-35">{{ $child_sub->title }}</span>
                                                <div class="btn_action_area pl-20">
                                                    <a href="{{ route('admin.editprogramme',$child_sub->id) }}" target="_self">Edit</a>
                                                    <a href="#" class="text-danger page_trash" data-id="{{ $child_sub->id }}">Trash</a>
                                                    <a href="{{ url('programmes/'.$child->slug.'/'.$child_sub->slug) }}" target="_blank">View</a>
                                                </div>
                                            </td>
                                            <td>{{ $child_sub->author ? $child_sub->author->name : 'No Author' }}</td>
                                            <td></td>
                                            <td><span><input type="number" min="0" max="999" value="{{ $child_sub->order }}" class="order_change" data-id="{{ $child_sub->id.'/'.$child_sub->order }}"/></span></td>
                                            <td>
                                                <select class="form-control selected_page" name="selected_page" data-id="{{ $child_sub->id.'/'.$child_sub->parent }}">
                                                    <option value="0">Select Page {{ $child_sub->parent }}</option>
                                                    @foreach($programmes_list as $prog)
                                                        {{-- @if($programme->id != $prog->id) --}}
                                                            <option value="{{ $prog->id }}" {{ $child_sub->parent == $prog->id ? 'selected' : '' }}>{{ $prog->title }}</option>
                                                        {{-- @endif --}}
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="publish_badge">Published</div>
                                                <div class="date_time">{{ \Carbon\Carbon::parse($child->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                                            </td>
                                        </tr>
                                     @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
			</tbody>
			<tfoot>
				<tr class="action_area">
					<th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all_footer" name="check_all"/></th>
					<th class="tbl_col2">Title</th>
					<th class="tbl_col3">Author</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
					<th class="tbl_col5">Order</th>
					<th class="tbl_col6">Parent</th>
					<th class="tbl_col5">Date</th>
				</tr>
			</tfoot>
		</table>
    </div>
  </div>
</div>
</div>
</div>


@endsection

@push('css')
    <style>
        .pl-20 {
            padding-left: 20px;
        }
        .pl-35 {
            padding-left: 35px;
        }
        .parent_class td {
            background-color: #8e834d !important;
        }
        .parent_sub_class td {
            background-color: #aeaca0 !important;
        }
    </style>
@endpush

@push('scripts')
<script>
	$(document).ready(function() {

    $('.selected_page').on('change',function(){
        let page_data = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected Page ID: ", page_data);
        let page_arr = page_data.split('/');

        console.log("Selected Page ID: ", page_arr[0], "ID : ",page_arr[1]);
        let id = page_arr[0];
        let page_no = page_arr[1];
        let page_no_current = $(this).val();
        //console.log("Selected order ID: ", order_no, "ID : ",id, "order_no_current: ", order_no_current);

        var ajax_url = "{{ route('admin.updatepageidprogramme', ':id') }}";
        ajax_url = ajax_url.replace(':id', id);
        ajax_url += `?page_no=${encodeURIComponent(page_no)}&page_no_current=${encodeURIComponent(page_no_current)}`;

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Update',
            'Are you sure you want to update this related page no..?',
            'Cancel',
            'Update',
            id,
            ajax_url,
            'POST'
        );
    });


    // $('.section_change').on('input',function(){
    //     let section_data = $(this).data('id'); // Use .data() instead of .attr()
    //     section_arr = section_data.split('/');
    //     let id = section_arr[0];
    //     let section_no = section_arr[1];
    //     let section_no_current = $(this).val();
    //     //console.log("Selected order ID: ", order_no, "ID : ",id, "order_no_current: ", order_no_current);

    //     var ajax_url = "{{ route('admin.updatesectionidaccording', ':id') }}";
    //     ajax_url = ajax_url.replace(':id', id);
    //     ajax_url += `?section_no=${encodeURIComponent(section_no)}&section_no_current=${encodeURIComponent(section_no_current)}`;

    //     // Call the AlertModelDetails function
    //     AlertModelDetails(
    //         'Confirm Update',
    //         'Are you sure you want to update this Sectionr no..?',
    //         'Cancel',
    //         'Update',
    //         id,
    //         ajax_url,
    //         'POST'
    //     );
    // });

    $('.order_change').on('input',function(){
        let order_data = $(this).data('id'); // Use .data() instead of .attr()
        order_arr = order_data.split('/');
        let id = order_arr[0];
        let order_no = order_arr[1];
        let order_no_current = $(this).val();
        //console.log("Selected order ID: ", order_no, "ID : ",id, "order_no_current: ", order_no_current);

        var ajax_url = "{{ route('admin.updateorderprogramme', ':id') }}";
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

    $('.page_trash').on('click', function () {
        let page_id = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected Page ID: ", page_id);

        var ajax_url = "{{ route('admin.deleteprogramme', ':id') }}";
        ajax_url = ajax_url.replace(':id', page_id);

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Deletion',
            'Are you sure you want to delete this programme.??',
            'Cancel',
            'Delete',
            page_id,
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
            //$.redirect(""+ajax_url+"", {page_id: page_id}, "DELETE", "_self");

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
            //             title: 'Page is deleted!',
            //             showConfirmButton: false,
            //             timer: 3500
            //         });
            //         // Optionally, you can remove the row from the table here.
            //         $('#page_row_' + page_id).remove(); // This is assuming each page has a row with an id `page_row_X`
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
