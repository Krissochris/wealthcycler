@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-content dib">
                            <div class="stat-text text-success">Savings Wallet</div>
                            <div class="stat-digit"><span>&#36;</span>  {{ number_format($saving_wallet->amount, 2)  }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->


        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-content dib">
                            <div class="stat-text text-info">Virtual Credit Wallet</div>
                            <div class="stat-digit"> <span>&#36;</span>  {{ number_format($virtual_wallet->amount, 2) }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->


        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-content dib">
                            <div class="stat-text text-danger">Debit Wallet</div>
                            <div class="stat-digit"> <span>&#36;</span> {{ number_format($debit_wallet->amount, 2) }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>

    <div class="col-lg- col-sm-12">
        <div class="card">
            <div class="card-header">View User</div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <th> Name </th>
                        <td> {{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th> Email </th>
                        <td> {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th> Username </th>
                        <td> {{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th> Phone Number </th>
                        <td> {{ $user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th> City </th>
                        <td> {{ $user->city }}</td>

                    <tr>
                        <th> State </th>
                        <td> {{ @$user->state->name }}</td>
                    </tr>
                    <tr>
                        <th> Country </th>
                        <td> {{ @$user->country->name }}</td>
                    </tr>
                    <tr>
                        <th> is pro user </th>
                        <td> {!! ($user->is_pro_member) ? '<span class="text-success"> Yes </span>' : '<span class="text-danger">No</span>' !!}</td>
                    </tr>
                    <tr>
                        <th> became pro user at </th>
                        <td> {{ $user->became_pro_member_at }}</td>
                    </tr>
                    <tr>
                        <th>pro member through</th>
                        <td> {{ $user->pro_member_through }} </td>
                    </tr>
                    <tr>
                        <th>status</th>
                        <td> {!! ($user->status) ? '<span class="text-success"> Yes </span>' : '<span class="text-danger">No</span>' !!} </td>
                    </tr>
                    @if ($director)
                        <tr>
                            <th> Director </th>
                            <td> {{ $director->title }} </td>
                        </tr>
                    @endif
                    @if ($coordinator)
                        <tr>
                            <th> Coordinator </th>
                            <td> {{ $coordinator->state->name }} </td>
                        </tr>
                    @endif
                    @if ($leader)
                        <tr>
                            <th> Leader </th>
                            <td> {{ $leader->state->name }} </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg- col-sm-12">
        <div class="card">
            <div class="card-header">View Referrals</div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Is pro-member</th>
                        <th>Date registered</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($referrals->isNotEmpty())
                            @foreach($referrals as $referral)
                                <tr>
                                    <td> {{ $referral->referred_user->name }} </td>
                                    <td> {{ ($referral->referred_user->is_pro_member) ? 'Yes' : 'No' }} </td>
                                    <td> {{ $referral->referred_user->created_at }} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="3"> No Referrals Yet!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    User Packages
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Package Name</th>
                            <th> Joined On</th>
                        </tr>
                        </thead>
                        @if ($userPackages)
                            @foreach($userPackages as $package)
                                <tr>
                                    <td> {{ $package->package->name }} </td>
                                    <td> {{ $package->created_at }} </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Provide Donations
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th> Status</th>
                            <th> Created At</th>
                        </tr>
                        </thead>
                        @if ($provideDonations)
                            @foreach($provideDonations as $provideDonation)
                                <tr>
                                    <td> {{ $provideDonation->amount }} </td>
                                    <td> {{ $provideDonation->status }} </td>
                                    <td> {{ $provideDonation->created_at }} </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Get Donations
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th> Status</th>
                            <th> Created At</th>
                        </tr>
                        </thead>
                        @if ($getDonations)
                            @foreach($getDonations as $getDonation)
                                <tr>
                                    <td> {{ $getDonation->amount }} </td>
                                    <td> {{ $getDonation->status }} </td>
                                    <td> {{ $getDonation->created_at }} </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>

        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Savings Wallet Transaction
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th> Status</th>
                            <th> Created At</th>
                        </tr>
                        </thead>
                        @if ($savingWalletTransactions)
                            @foreach($savingWalletTransactions as $savingWalletTransaction)
                                <tr>
                                    <td> {{ $savingWalletTransaction->amount }} </td>
                                    <td> {{ $savingWalletTransaction->description }} </td>
                                    <td> {{ $savingWalletTransaction->created_at }} </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Virtual Wallet Transaction
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th> Status</th>
                            <th> Created At</th>
                        </tr>
                        </thead>
                        @if ($virtualWalletTransactions)
                            @foreach($virtualWalletTransactions as $virtualWalletTransaction)
                                <tr>
                                    <td> {{ $virtualWalletTransaction->amount }} </td>
                                    <td> {{ $virtualWalletTransaction->description }} </td>
                                    <td> {{ $virtualWalletTransaction->created_at }} </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
