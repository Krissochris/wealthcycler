@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-sm pull-right" href="{{ route('user_withdrawals:create') }}">New Withdrawal</a>
                        My Savings Wallet Withdrawal Records
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Amount (in Dollar $)</td>
                                <td>Status </td>
                                <td>Comment </td>
                                <td>Created</td>
                                <td>Last Updated</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($userWithdrawals) && !empty($userWithdrawals))
                                @foreach($userWithdrawals as $userWithdrawal)
                                    <tr>
                                        <td> ${{ $userWithdrawal->amount }} </td>
                                        <td>
                                            @Switch($userWithdrawal->status)
                                                @case(1)
                                                <span class="text-primary"> Active </span>
                                                @break
                                                @case(2)
                                                <span class="text-success">Completed</span>
                                                @break
                                                @case(-1)
                                                <span class="text-danger"> Cancelled </span>
                                                @break
                                                @default
                                                <span class="">Unknown</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            {{ $userWithdrawal->comment }}
                                        </td>
                                        <td> {{ $userWithdrawal->created_at }} </td>
                                        <td> {{ $userWithdrawal->updated_at }} </td>
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
