@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title my-auto">Dashboard</h1>
            </div>
            <!-- PAGE-HEADER END -->


            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card custom-card card-bg-primary">
                        <div class="card-body row">
                            
                            <div class="d-flex align-items-center w-100">
                                <div class="px-2 py-1 me-2 " style="border-radius: 50%; border: 1px solid white;">
                                    <i class="fe fe-user side-menu__icon"></i>
                                </div>
                                <div class="">
                                    <div class="fs-15 fw-semibold">{{\App\Models\User::all()->count()}}</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">No of User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card custom-card card-bg-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="px-2 py-1 me-2 " style="border-radius: 50%; border: 1px solid white;">
                                    <i class="fe fe-map-pin side-menu__icon"></i>
                                </div>
                                <div class="">
                                    <div class="fs-15 fw-semibold">{{\App\Models\RideRequest::all()->count()}}</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">Total Rides Created</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card custom-card card-bg-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="px-2 py-1 me-2 " style="border-radius: 50%; border: 1px solid white;">
                                    <i class="fe fe-alert-triangle side-menu__icon"></i>
                                </div>
                                <div class="">
                                    <div class="fs-15 fw-semibold">{{\App\Models\RideDrownies::all()->count()}}</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">Total Drownies Detected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card custom-card card-bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="px-2 py-1 me-2 " style="border-radius: 50%; border: 1px solid white;">
                                    <i class="fe fe-phone side-menu__icon"></i>
                                </div>
                                <div class="">
                                    <div class="fs-15 fw-semibold">{{\App\Models\Sos::all()->count()}}</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">Total SOS Number Added</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->super_admin)
                <div class="col-12 col-md-4">
                    <div class="card custom-card card-bg-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center w-100">
                                <div class="px-2 py-1 me-2 " style="border-radius: 50%; border: 1px solid white;">
                                    <i class="fe fe-users side-menu__icon"></i>
                                </div>
                                <div class="">
                                    <div class="fs-15 fw-semibold">{{\App\Models\Admin::all()->count()}}</div>
                                    <p class="mb-0 text-fixed-white op-7 fs-12">No of Admins</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                New Users
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                             Registered At   
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\User::orderBy('id', 'DESC')->limit(5)->get() as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                New Ride Request
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                Source
                                            </th>
                                            <th>
                                                Destination
                                            </th>
                                            <th>
                                             Status   
                                            </th>
                                            <th>
                                             Created At   
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\RideRequest::orderBy('id', 'DESC')->limit(5)->get() as $ride)
                                        <tr>
                                            <td>{{$ride->source}}</td>
                                            <td>{{$ride->destination}}</td>
                                            <td>
                                                @if($ride->status=="pending")
                                                <span class="px-2 py-1 bg-warning text-white">Pending</span>
                                                @elseif($ride->status=="started")
                                                <span class="px-2 py-1 bg-info text-white">Started</span>
                                                @elseif($ride->status=="ended")
                                                <span class="px-2 py-1 bg-success text-white">Ended</span>
                                                @endif
                                            </td>
                                            <td>{{$ride->created_at->diffForHumans()}}</td>
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
    </div>
@endsection
