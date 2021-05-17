@extends("layouts.app")

@section("title")
    User Wallets
@stop

@section("content")
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4> User Savings Wallet </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Savings Wallet Amount </td>
                        <td>${{ number_format($savings_wallet->amount, 2) }}</td>
                    </tr>
                </table>


                {!! Form::open() !!}

                <div class="form-group">
                    {!! Form::label('amount', 'Amount') !!}
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('type', 'Type') !!}
                    {!! Form::select('type', ['credit' => 'Credit', 'debit' => 'Debit'], null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4> User Virtual Wallet </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Virtual Wallet Amount </td>
                        <td>${{ number_format($virtual_wallet->amount, 2) }}</td>
                    </tr>
                </table>

                {!! Form::open(['route' => ['virtual_wallet:edit', $virtual_wallet->user->id], 'method' => 'POST' ]) !!}

                <div class="form-group">
                    {!! Form::label('amount', 'Amount') !!}
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('type', 'Type') !!}
                    {!! Form::select('type', ['credit' => 'Credit', 'debit' => 'Debit'], null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>


    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4> Dividend Wallet </h4>
            </div>
            <div class="card-body">

                @if ($dividend_wallet)
                    <table class="table">
                        <tr>
                            <td>Dividend Wallet Amount </td>
                            <td>${{ number_format($dividend_wallet->balance, 2) }}</td>
                        </tr>
                    </table>

                    {!! Form::open(['route' => ['dividend_wallets:add_transaction', $dividend_wallet->id], 'method' => 'POST' ]) !!}

                    <div class="form-group">
                        {!! Form::label('amount', 'Amount') !!}
                        {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type', ['credit' => 'Credit', 'debit' => 'Debit'], null, ['class' => 'form-control']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                @else
                    <div class="alert alert-danger">
                        <p>
                            User have not dividend wallet.
                        </p>
                    </div>

                @endif

            </div>

        </div>
    </div>

@endsection
