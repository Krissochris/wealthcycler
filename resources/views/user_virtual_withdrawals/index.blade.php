@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-sm pull-right" href="{{ route('user_virtual_withdrawals:create') }}">New Withdrawal</a>
                        My Virtual Wallet Withdrawal Records
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Amount (in Dollar $)</td>
                                <td>Status </td>
                                <td>Created</td>
                                <td>Last Updated</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($userVirtualWithdrawals) && !empty($userVirtualWithdrawals))
                                @foreach($userVirtualWithdrawals as $userVirtualWithdrawal)
                                    <tr>
                                        <td> ${{ $userVirtualWithdrawal->amount }} </td>
                                        <td> {{ $userVirtualWithdrawal->created_at }} </td>
                                        <td> {{ $userVirtualWithdrawal->updated_at }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection