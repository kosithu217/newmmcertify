@extends('admin.layouts.admin_master')

@section('title')
    Admin : Dashboard
@endsection

@section('content')

<div class="row">
    <div class="col-12 position-relative z-index-2">
        <div class="card card-plain mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                            <h2 class="font-weight-bolder mb-0">Admin Dashboard Panel</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">

            @hasrole('super-admin')
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                <a href="{{ url('/admin/users') }}" class="text-decoration-none">
                    <div class="card h-100 mb-2">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">All College & Employer</p>
                                <h4 class="mb-0">
                                    <span class="d-block d-sm-inline" style="font-size: 0.7em;">College / University: </span>
                                    <span class="text-success">{{ $colleges_count }}</span>
                                </h4>
                                <h4 class="mb-0">
                                    <span class="d-block d-sm-inline" style="font-size: 0.7em;">Visitor / Employer: </span>
                                    <span class="text-info">{{ $employers_count }}</span>
                                </h4>
                            </div>
                        </div>
                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">
                                    <i class="material-icons text-sm">visibility</i> Click for Details
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                <a href="{{ url('/admin/certificates') }}" class="text-decoration-none">
                    <div class="card h-100 mb-2">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">All Certificates</p>
                                <h4 class="mb-0 text-primary">{{ $certificate_count }}</h4>
                                <h4 class="mb-0">&nbsp;</h4>
                            </div>
                        </div>
                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">
                                    <i class="material-icons text-sm">visibility</i> Click for Details
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endhasrole

        </div>
    </div>

</div>

@endsection
