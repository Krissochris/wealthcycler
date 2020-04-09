@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> New Currency Exchange Rate </h4>
            </div>
            <div class="card-body">

                {!! Form::open(['route' => 'currency_exchange_rates:store']) !!}

                <div class="form-group">
                    {!! Form::label('rate', 'Rate') !!}
                    {!! Form::text('rate', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('target_currency', 'Target Currency') !!}

                    @if (request()->has('currency_id'))
                        {!! Form::select('target_currency', $currencies, request()->get('currency_id') , [
                        'class' => 'form-control',
                        'readonly' => true
                        ]) !!}
                    @else
                        {!! Form::select('target_currency', $currencies, null, ['class' => 'form-control']) !!}
                    @endif
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection