@extends('admin.layouts.master')

@section('title')
    Institutes Management
@endsection

@section('content')
<style>
    .btn-group .btn {
        border-radius: 8px !important;
        margin: 0 2px;
        transition: all 0.3s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    
    .btn-group .btn:first-child {
        margin-left: 0;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Institutes Management</h5>
                    <a href="{{ route('connect-hub.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i>Add New Institute
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Institute Name</th>
                                    <th>Location</th>
                                    <th>Contact</th>
                                    <th>Verified</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($institutes as $institute)
                                    <tr>
                                        <td>
                                            <strong>{{ $institute->institute_name }}</strong>
                                            @if($institute->mmcertify_verified)
                                                <span class="badge bg-success ms-1">Verified</span>
                                            @endif
                                        </td>
                                        <td>{{ $institute->location ?? 'N/A' }}</td>
                                        <td>
                                            @if($institute->email)
                                                <small>{{ $institute->email }}</small><br>
                                            @endif
                                            @if($institute->phone)
                                                <small>{{ $institute->phone }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($institute->mmcertify_verified)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($institute->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('connect-hub.show', $institute->id) }}" class="btn btn-outline-primary btn-sm" title="View">
                                                    View
                                                </a>
                                                <a href="{{ route('connect-hub.edit', $institute->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                                                    Edit
                                                </a>
                                                @if($institute->status)
                                                    <form action="{{ route('connect-hub.destroy', $institute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this institute?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('connect-hub.restore', $institute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to restore this institute?')">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-outline-success btn-sm" title="Restore">
                                                            Restore
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No institutes found</p>
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
</div>
@endsection
