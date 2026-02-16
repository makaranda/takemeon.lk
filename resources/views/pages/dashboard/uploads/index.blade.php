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
                    <a href="{{ route('admin.createupload') }}" id="add_file" name="add_file" class="btn btn-gray border float-right">Add File</a>
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
					<th class="tbl_col2">Type</th>
					<th class="tbl_col2">File</th>
					<th class="tbl_col3">Author</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
					<th class="tbl_col5">Date</th>
				</tr>
			</thead>
			<tbody>
                @if($uploads)
                    @foreach ($uploads as $upload)
                        <tr class="action_area">
                            <td><input type="checkbox" class="form-check-input" name="check_single"/></td>

                            <td>
                                <span>{{ $upload->type }}</span>
                                <div class="btn_action_area">
                                    <input type="hidden" class="copyNameValue" value="{{ url('public/assets/uploads/pages/'.$upload->file_name) }}" id="P{{ $upload->id }}"/>
                                    <a href="{{ route('admin.editupload',$upload->id) }}" target="_self">Edit</a>
                                    <a href="#" class="text-danger page_trash" data-id="{{ $upload->id }}">Trash</a>
                                    <button type="button" id="B{{ $upload->id }}" class="btn btn-link copy_img_path" onclick="copyToClipboard('#P{{ $upload->id }}')">Copy Path</button>
                                </div>
                            </td>
                            <td>
                                @php
                                    $ext = pathinfo($upload->file_name, PATHINFO_EXTENSION);
                                    $fileUrl = url('public/assets/uploads/pages/' . $upload->file_name);
                                @endphp
                                @if ($upload->type === 'image')
                                    <img src="{{ $fileUrl }}" alt="{{ $upload->type . '/' . $upload->id }}" width="250px"/>
                                @elseif ($upload->type === 'media')
                                    @if (in_array($ext, ['mp3', 'wav', 'ogg']))
                                        <audio controls width="250">
                                            <source src="{{ $fileUrl }}" type="audio/{{ $ext }}">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    @elseif (in_array($ext, ['mp4', 'webm']))
                                        <video controls width="250">
                                            <source src="{{ $fileUrl }}" type="video/{{ $ext }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <p>Unsupported media format</p>
                                    @endif
                                @elseif ($upload->type === 'document')
                                    <a href="{{ $fileUrl }}" target="_blank">View Document</a>
                                @endif
                            </td>
                            <td>{{ $upload->author ? $upload->author->name : 'No Author' }}</td>
                            <td></td>
                            <td>
                                <div class="publish_badge">Published</div>
                                <div class="date_time">{{ \Carbon\Carbon::parse($upload->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                            </td>
                        </tr>
                    @endforeach
                @endif
			</tbody>
			<tfoot>
				<tr class="action_area">
					<th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all_footer" name="check_all"/></th>
					<th class="tbl_col2">Title</th>
                    <th class="tbl_col2">File</th>
					<th class="tbl_col3">Author</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
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

    </style>
@endpush

@push('scripts')
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        //alert(element);
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        var btndata = element.replace('P', 'B');
        //$('.copyName').text('<i class="fas fa-copy"></i>');
        $(''+btndata+'').text('Coppied');
        setTimeout(function(){
            $(''+btndata+'').text('Copy Path');
        }, 3000);

    }
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

    $('.page_trash').on('click', function () {
        let page_id = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected Page ID: ", page_id);

        var ajax_url = "{{ route('admin.deleteuploade', ':id') }}";
        ajax_url = ajax_url.replace(':id', page_id);

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Deletion',
            'Are you sure you want to delete this File..??',
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
