@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-sm pull-right" href="{{ route('user_withdrawals:create') }}">New Withdrawal</a>
                        User Withdrawal Records
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>Amount (in Dollar $)</td>
                                <td>Status </td>
                                <td>Type </td>
                                <td>Payment Details</td>
                                <td>Created</td>
                                <td>Last Updated</td>
                                <td> Actions </td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($withdrawals) && !empty($withdrawals))
                                @foreach($withdrawals as $userWithdrawal)
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

                                        <td> {{ $userWithdrawal->type }} </td>
                                        <td> payment details </td>
                                        <td> {{ $userWithdrawal->created_at }} </td>
                                        <td> {{ $userWithdrawal->updated_at }} </td>
                                        <td>
                                            <a href="{{ route('withdrawals:view', $userWithdrawal->id) }}">view</a> |
                                            <a href="{{ route('withdrawals:edit', $userWithdrawal->id) }}">edit</a>
                                        </td>
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
