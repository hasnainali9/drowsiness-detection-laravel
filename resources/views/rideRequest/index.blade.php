@extends('layout.app')

@section('title')
    Ride List
@endsection

@section('content')
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title my-auto">Ride Request List</h1>
                <div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Ride Request</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->



            <!-- Start:: row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Manage Ride Request
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="ms-auto d-block mb-3 btn btn-primary add-model" data-href="{{route('ride-requests.create')}}">Add New Ride Request</button>
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-2 -->

        </div>
    </div>
    <!-- End::app-content -->
@endsection



@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
