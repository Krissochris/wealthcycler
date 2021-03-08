@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Become pro member </div>

                    <div class="card-body">
                        <p>
                            <strong>
                                To become a pro member, you would have to pay a one-time fee of $30.
                            </strong>
                        </p>
                        <p>
                            The $30 you are paying is for TYEN CLUB lifetime Membership.
                        </p>
                        <p>
                            If you are an investor only, please do not request for TYEN CLUB Membership card,
                            and your $30 will be eligible for refund as stated in our REFUND Policy.
                        </p>
                        <p>
                            We pay every member/investor of TYEN CLUB $500 annual dividends for a lifetime
                            from SECUREWILLS INVESTMENT LTD as their yearly share return from the Company.
                        </p>

                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::open(['route' => 'become_pro_member:step_2', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label for=""> Select the payment method </label>
                                    <select name="payment_type" class="form-control">

                                        @foreach(config('payment_types') as $key => $value)
                                            <option value="{{ $key }}"> {{ $value }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Proceed to Checkout </button>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="col-sm-6">
                                {!! Form::open(['route' => 'become_pro_member:verify_coupon_code']) !!}
                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code</label>
                                        {!! Form::text('coupon_code', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Verify Coupon </button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
