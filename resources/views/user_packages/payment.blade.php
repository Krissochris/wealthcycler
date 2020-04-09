@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Package Upgrade </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'user_packages:payment']) !!}

                        <div class="form-group">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Amount</td>
                                    <td> ${{ number_format($payment['amount'], 2) }} </td>
                                </tr>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for=""> Select the payment method </label>
                            <select name="payment_type" id="" class="form-control">
                                <option value="">--Select Payment Method -- </option>
                                @foreach(config('payment_types') as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::button('proceed', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
