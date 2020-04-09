@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Provide Donation</div>

                    <div class="card-body">
                        {!! Form::model($provideDonation,['route' => ['provide_donations:update', $provideDonation->id],'method' => 'PUT' ]) !!}
                        <div class="form-group">
                            {!! Form::label('User') !!}
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Package') !!}
                            {!! Form::select('package_id', $packages, null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status') !!}
                            {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
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