@extends('admin.layouts.admin_master')

@section('title')
    Admin : College & Employer
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
@endsection

@section('content')

    <style>
        .table td{
            padding: 0.75rem 1.5rem !important;
        }
    </style>
    
    @session('success')
        <p class="text-center text-white py-3 bg-success">{{ session('success') }}</p>
    @endsession
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                            <a href="{{ url('/admin/user/create') }}" class="btn btn-success" style="float: right;margin: 0; margin-right: 2em;">Create</a>
                            <h6 class="text-white text-capitalize ps-3">College / University Listssss</h6>
                            <p></p>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="users">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registration Name / Number</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Certificate Limit</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Contact Name / Phone</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Address</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Approved</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($colleges as $key => $user)
                                        
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->reg_number }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $user->email }}
                                                @if($user->email_verified_at)
                                                    <i class="material-icons opacity-10 text-success text-xs">check_circle</i>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-success font-weight-bold">
                                            {{ $user->cert_limit }}
                                            <a href="{{ url('/admin/user/'.$user->id.'/limit') }}" class="text-info font-weight-bold text-xs" title="edit">
                                                <i class="material-icons opacity-10 text-info" style="font-size: 1.3em;">edit</i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->contact_name }}</p>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->address }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($user->approved)
                                                <i class="material-icons opacity-10 text-success">check_circle</i>
                                            @else
                                                <a href="{{ url('/admin/user/'.$user->id.'/approve') }}" class="btn btn-warning" style="font-size: 0.6em !important; padding: 1em 1.5em; margin: 0;">Approve</a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="text-info font-weight-bold text-xs">
                                                Edit
                                            </a>
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
    
    <!--Employers-->
    <!-- <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <a href="{{ url('/user/certificate/create') }}" class="btn btn-success" style="float: right;margin: 0; margin-right: 2em;">Create</a>
                            <h6 class="text-white text-capitalize ps-3">Visitor / Employer Lists</h6>
                            <p></p>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="employers">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Approve</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($employers as $key => $user)
                                        
                                    <tr>
                                        
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                        </td>
                                        <td class="align-middle text-left text-sm" style="word-wrap: break-word; white-space: normal;">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $user->email }}
                                                @if($user->email_verified_at)
                                                    <i class="material-icons opacity-10 text-success text-xs">check_circle</i>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($user->approved)
                                                <i class="material-icons opacity-10 text-success">check_circle</i>
                                            @else
                                                <a href="{{ url('/admin/user/'.$user->id.'/approve') }}" class="btn btn-warning" style="font-size: 0.6em !important; padding: 1em 1.5em; margin: 0;">Approve</a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="text-info font-weight-bold text-xs">
                                                Edit
                                            </a>
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
    </div> -->
@endsection

@section('js')
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            
            var table = $('#users').DataTable({
                            order: [[0, 'desc']], // Sort by first column (No/ID) in descending order
                            columnDefs: [{
                                targets: [7], // Make the last column (Actions) non-sortable
                                orderable: false,
                            }],
                        });
            
            var employers = $('#employers').DataTable({
                            order: [[0, 'desc']], // Sort by first column (No/ID) in descending order
                            columnDefs: [{
                                targets: [4], // Make the last column (Actions) non-sortable
                                orderable: false,
                            }],
                        });
                   
                   
        });
    </script>
@endsection
