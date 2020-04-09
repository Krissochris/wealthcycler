@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> New Currency </h4>
            </div>
            <div class="card-body">

                {!! Form::open(['route' => 'currencies:store']) !!}
                <div class="form-group">
                    {!! Form::label('code', 'Code') !!}
                    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 3]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection