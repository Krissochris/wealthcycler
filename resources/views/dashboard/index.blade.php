@extends('layouts.app')

@section('content')

    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-content dib">
                        <div class="stat-text text-success">Total Users</div>
                        <div class="stat-digit"> {{ number_format($totalUsers) }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->


    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-content dib">
                        <div class="stat-text text-info">Pro User</div>
                        <div class="stat-digit"> {{ number_format($totalProUser) }}  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->


    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    {{--
                                        <div class="stat-icon dib"><i class="ti-money text-danger" style=""> <span>&#36;</span> </i></div>
                    --}}
                    <div class="stat-content dib">
                        <div class="stat-text text-primary"> Maintenance Fee </div>
                        <div class="stat-digit"> <span>&#36;</span> {{ number_format($totalMaintenanceFees, 2) }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-content dib">
                        <div class="stat-text text-danger">Active Withdrawals</div>
                        <div class="stat-digit"> <span>&#36;</span>  {{ number_format($totalActiveWithdrawals, 2) }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
