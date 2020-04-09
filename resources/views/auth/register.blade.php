@extends('layouts.auth')

@section('title')
    User Sign Up
@stop

@section('content')
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper" style="background-image:url({{ asset('assets/images/background/bg-9.jpg') }});">
            <div class="overlay-main bg-black opacity-07"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <h1 class="text-white">Register an Account</h1>
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

        <!-- BREADCRUMB ROW -->
        <div class="bg-gray-light p-tb20">
            <div class="container">
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li>Register an Account</li>
                </ul>
            </div>
        </div>
        <!-- BREADCRUMB  ROW END -->

        <!-- ABOUT COMPANY SECTION START -->
        <section class="register">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        {{ setting('app.about_us') }}
                    </div>
                    <div class="col-sm-8">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Full Name </label>
                                        <div class="">
                                            <input id="name" type="text" placeholder="Enter Full Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email_address">Email </label>
                                        <input id="email_address" type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="username"> Username </label>
                                        <input id="username" type="text" class="form-control" name="username" placeholder="Enter Username" value="{{ old('username') }}" required="">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password"> Password</label>
                                        <input id="password" type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm"> Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="phone_number"> Phone Number </label>
                                        <input id="phone_number" type="text" placeholder="Enter Cell Number" class="form-control form-control-lg {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city"> City </label>
                                        <input id="city" type="text" class="form-control" name="city" placeholder="City" value="" required="">
                                    </div>

                                    @if (isset($countries))
                                        <div class="form-group">
                                            <label for="country_id"> Country </label>

                                            <select class="form-control form-control-lg"  name="country_id" id="country_id" required>
                                                @foreach( $countries as $id => $country)
                                                    <option value="{{$id}}"> {{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if(isset($states))
                                        <div class="form-group">
                                            <label for="state_id">State</label>
                                            {!! Form::select('state_id',$states, null, ['class' => 'form-control form-control-lg', 'id' => 'state_id']) !!}
                                        </div>
                                    @endif

                                    @if(isset($leaders))
                                        <div class="form-group">
                                            <label for="leader_id">Leader</label>
                                            {!! Form::select('leader_id',$leaders, null, ['class' => 'form-control form-control-lg select-2', 'id' => 'leader_id']) !!}
                                        </div>
                                    @endif



                                    <div class="form-group">
                                        <label for="referral-email"> Coupon Code (Optional)  </label>
                                        {!! Form::text('coupon_code', null, ['class' => 'form-control form-control-lg','id' => 'coupon_code']) !!}
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="tos">
                                        <input  id="tos" type="checkbox" name="tos">
                                        I AGREE WITH THE <a href="{{ route('pages:view', 'page_terms_&_conditions') }}"> Terms and conditions </a>
                                    </label><br>
                                    @if (Route::has('login'))
                                        <p>Already have an account? &nbsp; <a href="{{ route('login') }}">LOGIN</a></p>

                                    @endif
                                    <br>
                                    <br>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button type="submit" class="site-button slider-btn-left">
                                            Register
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
