@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Make a Withdrawal (From the Savings wallet )</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'user_withdrawals:store']) !!}
                        <div class="form-group">
                            {!! Form::label('Amount (USD $)') !!} Amount in Savings Wallet : ${{ number_format(auth()->user()->saving_wallet->amount, 2) }}
                            {!! Form::text('amount',null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type',['bank_details' => 'Bank Details', 'bitcoin' => 'Bitcoin'], null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
