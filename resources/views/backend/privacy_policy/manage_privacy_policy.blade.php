@extends('admin.layouts.master')
@section('title') Privacy Policy @endsection

@section('content')
@component('admin.components.breadcrumb')
@slot('li_1') <a href="{{route('manage.privacy.policy')}}">Privacy Policy</a> @endslot
@slot('title') Manage @endslot
@endcomponent


<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Manage Privacy Policy</h5>
            </div>
            <div class="card-body">
                <table id="alternative-pagination" class="table responsive align-middle table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl.</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($privacy_policy as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {!! $item->details !!}
                            </td>
                            <td>
                                <div class="hstack gap-3 flex-wrap"> 
                                    @can('settings.privacyPolicy.edit')
                                        <a href="{{ route('edit.privacy.policy', $item->id) }}" class="fs-15"><i class="ri-edit-2-line"></i></a> 
                                    @endcan
                                    
                                    @can('settings.privacyPolicy.delete')
                                        <a href="{{ route('delete.privacy.policy',$item->id) }}" onclick="return confirm('Are you sure you want to delete this Policy')" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a> 
                                    @endcan
                                   
                                </div>
                            </td>
                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-6">
        <form method="POST" action="{{route('store.privacy.policy')}}" class="row g-3">
            @csrf
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add Privacy Policy</h4>
            </div><!-- end card header -->
    
            <div class="card-body">
                <div class="live-preview">
    
                        <div class="col-md-12">
                            <label class="form-label">Details</label>
                            <textarea name="details" class="form-control" id="tinymceExample" rows="10"></textarea>
                        </div>
                </div>
            </div>
        </div>
    
        <div class="col-12">
            <div class="text-end">
                <input type="submit" class="btn btn-rounded gradient-btn-save mb-5" value="Save">
            </div>
        </div>
    </form>
    </div>
</div>

@endsection

@include('admin.layouts.datatables')


@section('script')

<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection