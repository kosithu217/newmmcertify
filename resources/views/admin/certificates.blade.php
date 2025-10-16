@extends(Auth::user()->hasRole('user') ? 'admin.layouts.master' : 'admin.layouts.admin_master')

@section('title')
    Admin : Certificates
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
@endsection

@section('content')
    <style>
        .table td {
            padding: 0.75rem 1.5rem !important;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                            @if(Auth::user()->hasRole('user'))
                                <a href="{{ url('/user/certificate/create') }}" class="btn btn-success" style="float: right; margin: 0; margin-right: 2em;">Start</a>
                            @endif
                            <h6 class="text-white text-capitalize ps-3">Certificate Lists</h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="certificates">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qr Generate</th>
                                        <th class="text-secondary opacity-7"></th>
                                        @if(Auth::user()->hasRole('user'))
                                            <th class="text-secondary opacity-7"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Get all certificates for the authenticated user
                                        $certificates = auth()->user()->certificates()->latest()->get();
                                        $totalCertificates = $certificates->count();
                                    @endphp

                                    @foreach($certificates as $key => $certificate)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $totalCertificates - $key }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $certificate->name }}</p>
                                        </td>
                                        <td class="align-middle text-left text-sm" style="word-wrap: break-word; white-space: normal;">
                                            <span class="text-secondary text-xs font-weight-bold">{{ Str::limit(strip_tags($certificate->description), 100, '...') }}</span>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $certificate->created_at->format('M d, Y') }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($certificate->generated)
                                                <span class="badge badge-sm bg-gradient-success">Generated</span>
                                            @else
                                                @if(Auth::user()->hasRole('user'))
                                                    <form action="{{ url('/user/certificate/qr/'.$certificate->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info" style="margin: 0; padding: 0.5em; font-size: 0.7em; text-transform: none;">
                                                            Generate QR & ID
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ url('/admin/certificate/qr/'.$certificate->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info" style="margin: 0; padding: 0.5em; font-size: 0.7em; text-transform: none;">
                                                            Generate QR & ID
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($certificate->generated)
                                                @if(Auth::user()->hasRole('user'))
                                                    <a class="badge badge-sm bg-gradient-success" href="{{ url('/user/certificates/detail/'.$certificate->id) }}">View</a>
                                                @else
                                                    <a class="badge badge-sm bg-gradient-success" href="{{ url('/admin/certificates/detail/'.$certificate->id) }}">View</a>
                                                @endif
                                            @endif
                                        </td>
                                        @if(Auth::user()->hasRole('user'))
                                            <td>
                                                <a href="{{ url('/user/certificate/'.$certificate->id.'/edit') }}" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                        @endif
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

@section('js')
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#certificates').DataTable({
                order: [], // Disable initial sorting to respect the Blade order
                columnDefs: [
                    {
                        targets: '_all', // All columns
                        orderable: true // Make all columns sortable
                    }
                ],
                pageLength: 10, // Show 10 entries per page
                lengthMenu: [5, 10, 25, 50, 100], // Options for entries per page
                searching: true, // Enable search
                paging: true, // Enable pagination
                info: true // Show table information
            });
        });
    </script>
@endsection