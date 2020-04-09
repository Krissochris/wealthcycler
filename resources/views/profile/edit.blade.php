@extends('layouts.app')

@section('content')
    <div class="col-lg- col-sm-12">
        <div class="card">
            <div class="card-header">Edit User</div>

            <div class="card-body">
                {!! Form::model($user, ['route' => ['profile:edit'] ]) !!}
                <div class="form-group">
                    {!! Form::label('Name') !!}
                    {!! Form::text('name',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'readonly' => true]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', null, ['class' => 'form-control', 'readonly' => true]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone_number', 'Phone Number') !!}
                    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::label('city') !!}
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('state_id', 'State') !!}
                    {!! Form::select('state_id', $states,null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id', 'Country') !!}
                    {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">Edit Payment Details</div>

            <div class="card-body">
                {!! Form::model($userPaymentDetails, ['route' => ['payment_details:edit'] ]) !!}
                <div class="form-group">
                    {!! Form::label('Account Name') !!}
                    {!! Form::text('account_name',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('account_number', 'Account Number') !!}
                    {!! Form::text('account_number', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('bank_id', 'Bank') !!}
                    {!! Form::select('bank_id', $banks, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('btc_address', 'BTC Address') !!}
                    {!! Form::text('btc_address', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
