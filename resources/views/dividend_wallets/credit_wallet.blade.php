@extends('layouts.app')

@section('title')
    Credit Dividend Wallet
@endsection

@section('content')
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header">Credit Dividend Wallet</div>

            <div class="card-body">
                {!! Form::open(['route' => 'dividend_wallets:credit_wallet']) !!}

                <div class="form-group">
                    {!! Form::label('Select Users') !!}

                    {!! Form::select('users_type', [
                        'all_pro_members' => 'All Pro Members (Total: '. count($users) . ')',
                         'specific_user' => 'Specific User'], null, ['class' => 'form-control', 'id' => 'users_type']) !!}
                </div>

                <div class="form-group" style="display:none;" id="users-dropdown">
                    {!! Form::label('user_id', 'Select One User') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('amount', 'Amount') !!}
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::button('Credit Wallets', ['class' => 'btn btn-primary', 'type' => 'submit', 'id'=> 'credit-wallet-button']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-sm-12 col-md-4">
        <div class="card">
            <div class="card-header">Instructions</div>
            <div class="card-body">
                <p class="text-danger text-uppercase">
                    Please note that any operation committed here is irreversible.
                </p>
                <ol>
                    <li> "All Pro Member" are only member that made payment to become pro members.</li>
                    <li> Any amount enter will be divided equally among all members if "All Pro Members" is selected.</li>
                    <li> To credit a specific member select "Specific Member" and select the user in the dropdown select box</li>
                </ol>
            </div>
        </div>

    </div>


    <script>

        (function() {
            document.getElementById('users_type')
                .addEventListener('change', function(event) {
                if (event.target.value === 'specific_user') {
                    document.getElementById('users-dropdown').style.display = 'block';
                    document.getElementById('credit-wallet-button').innerText = 'Credit Wallet';
                } else {
                    document.getElementById('users-dropdown').style.display = 'none';
                    document.getElementById('credit-wallet-button').innerText = 'Credit Wallets';
                }
            })
        })();

    </script>
@endsection
