@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> View User Withdrawal </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th> Amount </th>
                                <td> ${{ $withdrawal->amount }} </td>
                            </tr>
                            <tr>
                                <th> Type </th>
                                <td> {{ $withdrawal->type }}</td>
                            </tr>
                        </table>

                        <h5>User payment detail</h5>
                        @if($userPaymentDetail)
                        <table class="table">
                            <tr>
                                <th> Account Name </th>
                                <td> {{ $userPaymentDetail->account_name }} </td>
                            </tr>
                            <tr>
                                <th> Account Number</th>
                                <td> {{ $userPaymentDetail->account_number }} </td>
                            </tr>
                            <tr>
                                <th>Bank Name</th>
                                <td> {{ @$userPaymentDetail->bank->name }} </td>
                            </tr>
                            <tr>
                                <th>BTC Address</th>
                                <td> {{ @$userPaymentDetail->btc_address }} </td>
                            </tr>
                        </table>
                        @endif

                        @if ($withdrawal->status == 1)
                            <a href="javascript:;" class="btn btn-success btn-sm"
                               onclick="event.preventDefault();
                                   var response = confirm('Are you sure you want to complete this withdrawal? The withdrawal amount will be debited from the saving wallet.');
                                   if (response) {
                                   document.getElementById('{{ $withdrawal['id'] }}').submit(); }"
                            >
                                Mark as paid
                            </a>
                            <form id="{{ $withdrawal['id'] }}" action="{{ route('withdrawals:paid', $withdrawal['id']) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
