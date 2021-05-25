@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight: 600;">Become a Lifetime Member</h5>
                    </div>

                    <div class="card-body">
                        <p>
                            <strong>
                                To become a lifetime member of the TYEN CLUB FAMILY, you would have to pay a one-time fee, as shown on the payout page.
                            </strong>
                        </p>

                        <p>
                            The fee you are paying is for TYEN CLUB and TYCTI organization lifetime Membership.
                        </p>

                        <p>
                            If you would love <strong>“The Young Creative Thinkers Initiative”</strong>
                            to undertake the safety of your membership fee for the first 12 months and
                            offer you <strong>a full refund</strong> should in case you chose to sign out from the CLUB after 1 year of
                            <strong>"no value received;"</strong> then use only the <strong>“Bank Deposit”</strong>
                            payment option and make sure that you have <strong>read, understood, and acknowledged</strong>
                            the <strong>“refund terms and conditions”</strong> before making payments.
                        </p>

                        <p>
                            As a member of the TYEN CLUB Family, we pay you a <strong>$500 dividend annually</strong> for a
                            lifetime as your share returns from <strong>SECUREWILLS INVESTMENT LTD.</strong>
                        </p>

                        <p>
                            We shall also be granting you unlimited access to <strong>Premium courses</strong> offered
                            in TYEN Academy for FREE (T&C applies), plus other values as shown on the <strong>“Values to Expect”</strong> page.
                            We shall do our best through our expert mentors in different fields to see you
                            succeed in your chosen career and earn independently in hard currencies.
                        </p>

                        <p>
                            Join TYCT Initiative today, and become a lifetime partner and shareholder with
                            “Securewills Investment LTD” and every other company the organization would
                            be partnering with in the future.
                        </p>
                        <p>
                            Become a member, <strong>Learn and Earn</strong> for life.
                        </p>

                        <p>
                            Proudly Powered by: <strong>“The Young Creative Thinkers Initiative - RC No: 127873”</strong>
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
