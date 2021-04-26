@extends('layouts.app')

@section('content')
    <div class="col-lg- col-sm-8">
        <div class="card">
            <div class="card-header">Edit Dividend Wallet</div>

            <div class="card-body">
                {!! Form::open(['route' => ['dividend_wallets:update', $dividendWallet->id]]) !!}


                <div class="form-group">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $dividendWallet->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Balance</th>
                            <td>{{ number_format($dividendWallet->balance, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Is Active</th>
                            <td> {{ ($dividendWallet->is_active) ? 'Active' : 'Inactive' }} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ((int)$dividendWallet->status === 1)
                                    <span class="text-success">OK</span>
                                @elseif ((int)$dividendWallet->status === -1)
                                    <span class="text-danger">Suspended</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', ['1' => 'Active', '-1' => 'Suspend'], $dividendWallet->status, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
