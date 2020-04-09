@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Member </h4>
            </div>
            <div class="card-body">

                {!! Form::model($team, ['route' => ['teams:edit', $team->id], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('position', 'Position') !!}
                    {!! Form::text('position', null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('photo', 'Photo') !!}
                    {!! Form::file('photo', ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection
