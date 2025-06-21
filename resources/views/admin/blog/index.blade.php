@extends('admin.layouts.admin_master')

@section('title')
    Admin : Dashboard
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Blog Management</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Create New Blog Post</a>
                    </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Featured Image</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($blogs->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <p class="text-muted">No blog posts found. Click the "Create New Blog Post" button above to add one.</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $blog->title }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $blog->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($blog->featured_image)
                                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="img-thumbnail" style="max-width: 100px;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ $blog->status ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                {{ $blog->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this blog post?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
