@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Edit User Withdrawal </div>

                    <div class="card-body">
                        {!! Form::model($withdrawal, ['route' => ['withdrawals:edit', $withdrawal->id] ]) !!}
                        <div class="form-group">
                            {!! Form::label('Amount (USD $)') !!}
                            {!! Form::text('amount',null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type',['bank_details' => 'Bank Details', 'bitcoin' => 'Bitcoin'], null, ['class' => 'form-control', 'readonly' =>  true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status',[1 => 'Active', 2 => 'Completed', '-1' => 'Cancelled'], null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('comment', 'Comment') !!}
                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 4]) !!}
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
