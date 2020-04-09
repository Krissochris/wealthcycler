@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'users:store']) !!}
                        <div class="form-group">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('username', 'Username') !!}
                            {!! Form::text('username', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('phone_number', 'Phone Number') !!}
                            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Password Confirm') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
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
            </div>
        </div>
    </div>
@endsection
