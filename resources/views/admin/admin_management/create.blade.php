@extends('admin.layouts.admin_master')

@section('title', 'Create New Admin - MM Certify')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 mb-0">Create New Admin</h6>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.store-admin') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_super_admin" id="is_super_admin" value="1" {{ old('is_super_admin') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_super_admin">
                                    Super Admin (Full Access)
                                </label>
                                <small class="form-text text-muted d-block">Super admins have access to all menus and cannot be restricted.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="menu-permissions" style="{{ old('is_super_admin') ? 'display: none;' : '' }}">
                        <div class="col-12">
                            <h6 class="mb-3">Menu Permissions</h6>
                            <div class="row">
                                @foreach($availableMenus as $key => $label)
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="menu_permissions[]" value="{{ $key }}" id="menu_{{ $key }}" 
                                               {{ in_array($key, old('menu_permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="menu_{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn bg-gradient-primary">Create Admin</button>
                            <a href="{{ route('admin.admin-management') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.getElementById('is_super_admin').addEventListener('change', function() {
    const menuPermissions = document.getElementById('menu-permissions');
    if (this.checked) {
        menuPermissions.style.display = 'none';
        // Uncheck all menu permissions
        const checkboxes = menuPermissions.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = false);
    } else {
        menuPermissions.style.display = 'block';
    }
});
</script>
@endsection