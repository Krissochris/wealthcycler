@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Director </h4>
            </div>
            <div class="card-body">

                {!! Form::model($director, ['route' => ['directors:update', $director->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('user_id', 'User') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection