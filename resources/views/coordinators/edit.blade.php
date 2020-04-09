@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Coordinator </h4>
            </div>
            <div class="card-body">

                {!! Form::model($coordinator, ['route' => ['coordinators:update', $coordinator->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('user_id', 'User') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state_id', 'State') !!}
                    {!! Form::select('state_id', $states, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('director_id', 'Director') !!}
                    {!! Form::select('director_id', $directors, null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection