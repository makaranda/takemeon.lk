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
	<div class="row g-3 align-items-center">
	  <div class="col-auto">
		<select class="form-select" name="bulk_action" id="bulk_action">
			<option value="">Bulk Action</option>
			<option value="1">Move to Trash</option>
		</select>
	  </div>
	  <div class="col-auto">
		<button type="button" id="bulk_submit" name="bulk_submit" class="btn btn-light border">Apply</button>
	  </div>
	</div>
  <div class="row">
    <div class="col-12 col-md-12">
		<table id="pages_list" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr class="action_area">
					<th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all" name="check_all"/></th>
					<th class="tbl_col2">Title</th>
					<th class="tbl_col3">type</th>
					<th class="tbl_col6">Author</th>
					<th class="tbl_col7">Order</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
					<th class="tbl_col5">Date</th>
				</tr>
			</thead>
			<tbody>
                @if($musicTracks)
                    @foreach ($musicTracks as $musicTrack)
                      @php
                        $badge_colors = [
                                            'audio' => 'text-bg-primary',
                                            'video' => 'text-bg-warning',
                                            'beat' => 'text-bg-success',
                                        ];
                        $badge_color = $badge_colors[$musicTrack->type] ?? 'text-bg-secondary';  
                        $disable_track = ($musicTrack->status == 0) ? 'disable' : '';
                        
                      @endphp    
                    
                        <tr class="action_area {{ $disable_track }}">
                            <td><input type="checkbox" class="form-check-input" name="check_single"/></td>
                            <td>
                                <span>{{ $musicTrack->title }}</span>
                                <div class="btn_action_area">
                                    <a href="{{ route('admin.editmusictrack',$musicTrack->id) }}" target="_new">Edit</a>
                                    <a href="#" class="text-danger page_trash" data-id="{{ $musicTrack->id }}">Trash</a>
                                    {{-- <a href="{{ route('frontend.page',$musicTrack->id) }}" target="_new">View</a> --}}
                                </div>
                            </td>
                            <td><span class="badge {{ $badge_color }} text-capitalize">{{ $musicTrack->type ?? '' }}</span></td>
                            <td>{{ $musicTrack->author ? $musicTrack->author->name : 'No Author' }}</td>
                            <td>{{ $musicTrack->order ?? '' }}</td>
                            <td></td>
                            <td>
                                <div class="publish_badge">Published</div>
                                <div class="date_time">{{ \Carbon\Carbon::parse($musicTrack->updated_at)->format('Y/m/d \a\t g:i a') }}</div>
                            </td>
                        </tr>
                    @endforeach
                @endif
			</tbody>
			<tfoot>
				<tr class="action_area">
					<th class="tbl_col1"><input type="checkbox" class="form-check-input" id="check_all_footer" name="check_all"/></th>
					<th class="tbl_col2">Title</th>
					<th class="tbl_col3">Type</th>
					<th class="tbl_col6">Author</th>
					<th class="tbl_col7">Order</th>
					<th class="tbl_col4"><i class="fa fa-comment"></i></th>
					<th class="tbl_col5">Date</th>
				</tr>
			</tfoot>
		</table>
    </div>
  </div>
</div>

@endsection

@push('css')
    <style>
      tr.action_area.disable td {
          background-color: #ffbecd !important;
      }
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

    $('.page_trash').on('click', function () {
        let page_id = $(this).data('id'); // Use .data() instead of .attr()
        console.log("Selected Page ID: ", page_id);

        var ajax_url = "{{ route('admin.deletemusictrack', ':id') }}";
        ajax_url = ajax_url.replace(':id', page_id);

        // Call the AlertModelDetails function
        AlertModelDetails(
            'Confirm Deletion',
            'Are you sure you want to delete this Music Track?',
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
  });
</script>
@endpush
