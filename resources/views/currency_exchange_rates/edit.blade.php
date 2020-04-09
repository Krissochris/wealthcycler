@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Currency Exchange Rate </h4>
            </div>
            <div class="card-body">

                {!! Form::model($currencyExchangeRate, ['route' => ['currency_exchange_rates:update', $currencyExchangeRate->id], 'method' => 'PUT']) !!}

                <div class="form-group">
                    {!! Form::label('rate', 'Rate') !!}
                    {!! Form::text('rate', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('target_currency', 'Target Currency') !!}

                    {!! Form::select('target_currency', $currencies, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection