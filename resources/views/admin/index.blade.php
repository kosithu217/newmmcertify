@extends('admin.layouts.master')

@section('title')
    Admin : Dashboard
@endsection

@section('content')

<div class="row">
    <div class="col-12 position-relative z-index-2">
        <div class="card card-plain mb-4">
            <div class="card-body p-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="d-flex flex-column h-100 justify-content-center">
                            <h2 class="font-weight-bolder mb-0">{{ Auth::user()->name }}</h2> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4 col-sm-8 mx-auto mt-sm-4 mt-4">
                <a href="{{ url('/user/certificates') }}">
                    <div class="card  mb-2">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Certificates</p>
                                <h4 class="mb-0 "><span style="font-size: 0.8em;">Used Certificates</span> {{ count(Auth::user()->certificates) }}</h4>
                                <h4 class="mb-0 "><span style="font-size: 0.8em;">Purchased Certificates</span> {{ Auth::user()->cert_limit }}</h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">Click
                                    Detail</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- add here --}}


        </div>
    </div>

</div>

@endsection
