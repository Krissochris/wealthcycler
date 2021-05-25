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

                @if ($userPaymentDetails->edit_locked)
                    <div class="alert alert-info">
                        <p>
                            Your payment details can not be edited. You can contact support for any assistance.
                        </p>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th> Account Name</th>
                            <td>{{ $userPaymentDetails->account_name }}</td>
                        </tr>
                        <tr>
                            <th>Account Number</th>
                            <td>{{ $userPaymentDetails->account_number }}</td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{ $userPaymentDetails->bank->name }}</td>
                        </tr>
                        <tr>
                            <th>Bitcoin Address</th>
                            <td>{{ $userPaymentDetails->btc_address }}</td>
                        </tr>
                    </table>

                @else

                    {!! Form::model($userPaymentDetails, ['route' => ['payment_details:edit'],
                        'onsubmit' => 'event.preventDefault(); if (confirm("Please ensure you payment details are accurate. Once saved, you can not edit again.")){ this.submit(); } '
                        ]) !!}
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

                @endif

            </div>
        </div>

    </div>
@endsection
