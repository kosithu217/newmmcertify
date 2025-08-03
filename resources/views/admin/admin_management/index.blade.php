@extends('admin.layouts.admin_master')

@section('title', 'Admin Management - MM Certify')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-white text-capitalize ps-3 mb-0">Admin Management</h6>
                    <a href="{{ route('admin.create-admin') }}" class="btn btn-light btn-sm me-3">
                        <i class="material-icons text-sm">add</i> Create New Admin
                    </a>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if(session('success'))
                    <div class="alert alert-success mx-3">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mx-3">{{ session('error') }}</div>
                @endif

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Admin</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Permissions</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                <th class="text-secondary opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $admin->email }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($admin->isSuperAdmin())
                                        <span class="badge badge-sm bg-gradient-success">Super Admin</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-info">Admin</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @if($admin->isSuperAdmin())
                                        <span class="text-secondary text-xs font-weight-bold">All Permissions</span>
                                    @else
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $admin->adminPermission ? count($admin->adminPermission->menu_permissions ?? []) : 0 }} menus
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $admin->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.edit-admin', $admin->id) }}" class="btn btn-link text-dark px-3 mb-0">
                                        <i class="material-icons text-sm me-2">edit</i>Edit
                                    </a>
                                    @if(!$admin->isSuperAdmin() && $admin->id !== auth()->id())
                                    <form action="{{ route('admin.delete-admin', $admin->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger px-3 mb-0">
                                            <i class="material-icons text-sm me-2">delete</i>Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-secondary mb-0">No admins found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection