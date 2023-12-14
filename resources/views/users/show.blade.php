@extends('layout.app')

@section('title')
    User Detail
@endsection

@section('content')
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title my-auto">Users Detail</h1>
                <div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Users List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->


            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="col">Name</th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Email</th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>







            <!-- Start:: row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Manage User Ride Request
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $userRideRequestDataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-2 -->


            <!-- Start:: row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Manage User SOS
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $userSosDataTable->table() }}
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
    {{ $userRideRequestDataTable->scripts(attributes: ['type' => 'module']) }}
    {{ $userSosDataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
