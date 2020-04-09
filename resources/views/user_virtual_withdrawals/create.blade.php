@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Make a Withdrawal (From the virtual wallet )</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'user_virtual_withdrawals:store']) !!}
                        <div class="form-group">
                            {!! Form::label('Amount (USD $)') !!} Amount in Virtual Wallet : ${{ number_format(auth()->user()->virtual_wallet->virtual_credit, 2) }}
                            {!! Form::text('amount',null, ['class' => 'form-control']) !!}
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