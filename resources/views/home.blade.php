@extends('layouts.app')

@section('title')
    Dashboard
@stop

@section('content')
    @if (!auth()->user()->is_pro_member())
        <div class="col-sm-12">
            <div class="alert  alert-info alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-info">Info</span>
                You are not a pro member yet. Click <a href="{{ route('become_pro_member') }}">Here</a>  to become a pro member.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

    @endif

    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-content dib">
                        <div class="stat-text text-success">Savings Wallet</div>
                        <div class="stat-digit"><span>&#36;</span>  {{ number_format($user->saving_wallet->amount, 2)  }}</div>
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
                        <div class="stat-digit"> <span>&#36;</span>  {{ number_format($user->virtual_wallet->amount, 2) }} </div>
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
{{--
                    <div class="stat-icon dib"><i class="ti-money text-danger" style=""> <span>&#36;</span> </i></div>
--}}
                    <div class="stat-content dib">
                        <div class="stat-text text-danger">Debit Wallet</div>
                        <div class="stat-digit"> <span>&#36;</span> {{ number_format($user->debit_wallet->amount, 2) }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->

    @if (isset($user->dividend_wallet))
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-one">
                    <div class="stat-content dib">
                        <div class="stat-text text-success">Dividend Wallet</div>
                        <div class="stat-digit"> <span>&#36;</span> {{ number_format($user->dividend_wallet->balance, 2) }} </div>
                        <div>
                            @if((int)$user->dividend_wallet->status === \App\DividendWallet::STATUS_SUSPENDED)
                                <small> <span class="text-danger"><i class="fa fa-warning"></i> suspended </span> <i class="fa fa-info-circle" title="Account suspended"></i> </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
    @endif


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0">Latest Saving Wallet Transactions</h4>
                    </div>
                    <!--/.col-->
                    {{--<div class="col-sm-8 hidden-sm-down">
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option1"> Virtual
                                </label>
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="options" id="option2" checked=""> Savings
                                </label>
                            </div>
                        </div>
                    </div>--}}
                    <!--/.col-->

                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Description </th>
                        <th scope="col"> Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($savingsWalletTransactions as $record)
                        <tr>
                            <td></td>
                            <td>${{ $record->amount }}</td>
                            <td>{{ $record->description }}</td>
                            <td>{{ $record->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
