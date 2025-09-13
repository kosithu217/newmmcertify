@extends(Auth::user()->hasRole('user') ? 'admin.layouts.master' : 'admin.layouts.admin_master')

@section('title')
    Contact Info
@endsection

@section('css')
    <style>
        body{
            background: #f7f9fc;
        }
        .card {
            border-radius: 0.9rem;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }
        .card-header{
            border-top-left-radius: 0.9rem !important;
            border-top-right-radius: 0.9rem !important;
            background: linear-gradient(135deg, #434390 0%, #6b6bb3 100%) !important;
            padding: 0.9rem 1.25rem;
        }
        .profile-card{
            border: 1px solid #eef1f5;
            border-radius: 1rem;
            transition: transform .15s ease, box-shadow .15s ease;
            background: linear-gradient(#ffffff, #ffffff) padding-box,
                        linear-gradient(135deg, #ebeefe, #f7f8ff) border-box;
            border: 1px solid transparent;
            padding: 1.1rem 1.2rem;
        }
        .profile-card .title{
            font-weight: 700; color:#2f3b52; letter-spacing: .2px; font-size: 1.05rem;
        }
        .profile-card:hover{
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0,0,0,.10);
        }
        .logo-badge{
            width: 64px; height: 64px; border-radius: 14px; object-fit: cover; border: 1px solid #e9ecef; background:#fff;
        }
        .kv-label{ font-size: .72rem; color:#8a94a6; text-transform: uppercase; letter-spacing: .06em; margin-bottom: .08rem; }
        .kv-value{ color:#2f3b52; font-weight: 600; font-size: .96rem; }
        .color-chip{ width: 18px; height:18px; border-radius:6px; border: 1px solid #e9ecef; display:inline-block; vertical-align: -3px; }
        .link-truncate{ max-width: 100%; display:inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .empty-state{ border: 2px dashed #dfe3e8; border-radius: 1rem; background:#fbfbfc; }
        .meta-row{ display:flex; align-items:flex-start; gap:.6rem; }
        .meta-row i.material-icons{ font-size: 18px; color:#8392AB; }
        .btn-primary{ background-color:#434390; border-color:#434390; }
        .btn-outline-primary{ color:#434390; border-color:#d7daf0; }
        .btn-outline-primary:hover{ background:#f3f4ff; border-color:#c7cbf5; }
        .divider{ height:1px; background:#f0f2f5; margin: .85rem 0 1.1rem; }
        .muted{ color:#8a94a6; }
        .btn-icon{ display:inline-flex; align-items:center; gap:.35rem; }
        .btn-icon i{ font-size:18px; }
        .actions{ margin-top:.35rem; }
        .btn:hover{ filter: brightness(1.02); box-shadow: 0 4px 10px rgba(67,67,144,.12); }
        .grid-wrap{ max-width: 1200px; margin: 0 auto; }
        /* Single profile should use full available width */
        .single-profile .profile-card{ width: 100%; }
    </style>
@endsection

@section('content')
<div class="container py-4 grid-wrap">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow border-0 mb-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">Contact Info</div>
                        <div class="small" style="opacity:.9">Manage the information displayed in your site footer</div>
                    </div>
                    @if($profiles->where('user_id', Auth::id())->count() == 0)
                        <a href="{{ route('user.profile.create') }}" class="btn btn-light btn-sm" style="color:#434390;">+ Create Profile</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($profiles->isEmpty())
                        <div class="empty-state p-5 text-center">
                            <h5 class="mb-2" style="color:#2f3b52;">No contact info yet</h5>
                            <p class="text-muted mb-3">Create your organization contact details to show in the footer.</p>
                            <a href="{{ route('user.profile.create') }}" class="btn btn-primary" style="background-color:#434390;border-color:#434390;">Create Profile</a>
                        </div>
                    @else
                        <div class="row g-4 {{ $profiles->count() === 1 ? 'justify-content-center single-profile' : 'justify-content-start' }}">
                            @foreach($profiles as $profile)
                                <div class="{{ $profiles->count() === 1 ? 'col-12' : 'col-12 col-md-6 col-lg-5 col-xl-4' }}">
                                    <div class="profile-card p-3 h-100">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-3">
                                                @if($profile->logo)
                                                    <img src="{{ asset($profile->logo) }}" alt="Logo" class="logo-badge">
                                                @else
                                                    <div class="logo-badge d-flex align-items-center justify-content-center text-muted">N/A</div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="kv-label">Organization</div>
                                                <div class="kv-value title">{{ $profile->name }}</div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>

                                        <div class="meta-row mb-2">
                                            <i class="material-icons">call</i>
                                            <div>
                                                <div class="kv-label">Phone</div>
                                                <div class="kv-value">
                                                    @if($profile->phone)
                                                        <a href="tel:{{ preg_replace('/\s+/', '', $profile->phone) }}">{{ $profile->phone }}</a>
                                                    @else
                                                        <span class="muted">—</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="meta-row mb-2">
                                            <i class="material-icons">alternate_email</i>
                                            <div>
                                                <div class="kv-label">Email</div>
                                                <div class="kv-value">
                                                    @if($profile->email)
                                                        <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                                                    @else
                                                        <span class="muted">—</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="meta-row mb-2">
                                            <i class="material-icons">place</i>
                                            <div>
                                                <div class="kv-label">Address</div>
                                                <div class="kv-value" style="line-height:1.3">{{ $profile->address ?? '—' }}</div>
                                            </div>
                                        </div>
                                        <div class="meta-row mb-3">
                                            <i class="material-icons">palette</i>
                                            <div>
                                                <div class="kv-label">Brand Color</div>
                                                <div class="kv-value">
                                                    <span class="color-chip me-2" style="background: {{ $profile->color }}"></span>
                                                    <span class="text-muted">{{ $profile->color ?? '—' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="meta-row mb-3">
                                            <i class="material-icons">link</i>
                                            <div>
                                                <div class="kv-label">Weblink</div>
                                                @if($profile->weblink)
                                                    <a class="kv-value link-truncate" href="{{ $profile->weblink }}" target="_blank">{{ $profile->weblink }}</a>
                                                @else
                                                    <div class="kv-value text-muted">—</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2 actions">
                                            <a href="{{ route('user.profile.edit', $profile->id) }}" class="btn btn-sm btn-primary btn-icon"><i class="material-icons">edit</i> Edit</a>
                                            <a href="{{ $profile->weblink ?? '#' }}" target="_blank" class="btn btn-sm btn-outline-primary btn-icon"><i class="material-icons">open_in_new</i> View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- No table scripts needed for card layout -->
@endpush