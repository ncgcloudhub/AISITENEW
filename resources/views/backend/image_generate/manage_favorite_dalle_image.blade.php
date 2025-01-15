@extends('admin.layouts.master')
@section('title') Manage Favourite Images @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}">
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@component('admin.components.breadcrumb')
@slot('li_1') <a href="{{route('generate.image.view')}}">Images</a> @endslot
@slot('title') Manage Favourite Images @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Admin Manage Dalle</h5>
            </div>
            <div class="card-body">
                <table id="alternative-pagination" class="table responsive align-middle table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Image</th>
                            <th >Prompt</th>
                            <th>User ID/Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a class="image-popup" href="{{ asset($item->image_url) }}" title="">
                                    <div class="d-flex align-items-center fw-medium">
                                        <img src="{{ asset($item->image_url) }}" alt="" class="avatar-xxs me-2">
                                    </div>
                                </a>
                            </td>
                            
                            <td>{{ $item->prompt }}</td>
                            <td>{{ $item->user->id }}/{{ $item->user->name }}</td>
                            <td>{{ $item->status }}</td>

                            @if ($item->status == 'active')
                                <td>
                                    <div class="form-check form-switch form-switch-md" dir="ltr">
                                        <input type="checkbox" class="form-check-input active_button" id="customSwitchsizemd" data-image-id="{{ $item->id }}" checked>
                                        <label class="form-check-label" for="customSwitchsizemd"></label>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="form-check form-switch form-switch-md" dir="ltr">
                                        <input type="checkbox" class="form-check-input active_button" id="customSwitchsizemd" data-image-id="{{ $item->id }}">
                                        <label class="form-check-label" for="customSwitchsizemd"></label>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/gallery.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>


<!-- Include jQuery from CDN -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}

<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#alternative-pagination')) {
        var table = $('#alternative-pagination').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [10, 25, 50, 75, 100],
            "pageLength": 10,
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [
                { "orderable": false, "targets": [0, 4, 5] },
                { "className": "text-center", "targets": [0, 4, 5] }
            ]
        });
    }

    // Event delegation for the toggle button
    $(document).on('click', '.active_button', function() {
        var imageId = $(this).data('image-id');
        var toggleSwitch = $(this);

        // Send AJAX request to update the image status
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: '/update/image/status',
            data: {
                image_id: imageId
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Handle success response
                console.log(response);

                // Update the status text in the table cell
                if (toggleSwitch.is(':checked')) {
                    toggleSwitch.closest('td').prev().text('active');
                } else {
                    toggleSwitch.closest('td').prev().text('inactive');
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                console.log('inside Error');
            }
        });
    });
});

</script>

@endsection
