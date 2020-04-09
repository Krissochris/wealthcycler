@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make Deposit</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ $transaction->qrcode_url }}" alt="Qr-Code">
                            </div>
                            <div class="col-8">
                                <p>Status : {{ $transaction->status_text }}</p>
                                <p>Amount to Send : {{ $transaction->amount2 }} (total confirms needed : {{ $transaction->confirms_needed }})</p>
                                <p>Received so far : {{ $transaction->received_amount }} ({{ $transaction->received_amount }})</p>
                                <p> Send To Address : {{ $transaction->address }}</p>
                                <p> Time left to Confirm : {{ $transaction->timeout }}</p>
                                <p> Payment ID : {{ $transaction->txn_id }}</p>

                                <a class="btn btn-success" href="{{route('payment_processor:coin_payment:confirm_deposit')}}"> Confirm payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection    