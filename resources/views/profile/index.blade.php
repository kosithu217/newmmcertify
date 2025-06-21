@extends(Auth::user()->hasRole('user') ? 'admin.layouts.master' : 'admin.layouts.admin_master')

@section('title')
    Admin : Certificates
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">
           
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="
    background-color: #434390 !important;
">
                    <span class="fw-bold">Contact Info</span>
                    @if($profiles->where('user_id', Auth::id())->count() == 0)
                        <a href="{{ route('user.profile.create') }}" class="btn btn-success btn-sm">+ Create Profile</a>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="profiles-table" class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Color</th>
                                    <th>Logo</th>
                                    <th>Weblink</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
               </tr>
           </thead>
           <tbody>
               @foreach($profiles as $profile)
                   <tr>
                       <td>{{ $profile->name }}</td>
                       <td>{{ $profile->phone }}</td>
                       <td>{{ $profile->address }}</td>
                       <td>
                           <span style="display:inline-block;width:24px;height:24px;background:{{ $profile->color }};border-radius:4px;"></span>
                           <span class="ms-2">{{ $profile->color }}</span>
                       </td>
                       <td>
                       
                               <img src="{{ asset($profile->logo) }}" alt="Logo" width="50" height="50" style="object-fit:cover; border-radius:6px;"/>
                         
                          
                       </td>
                       <td>
                           @if($profile->weblink)
                               <a href="{{ $profile->weblink }}" target="_blank">{{ $profile->weblink }}</a>
                           @endif
                       </td>
                       <td>
                           <a href="{{ route('user.profile.edit', $profile->id) }}" class="btn btn-sm btn-primary">Edit</a>
                       </td>
                   </tr>
               @endforeach
           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#profiles-table').DataTable();
    });
</script>
@endpush