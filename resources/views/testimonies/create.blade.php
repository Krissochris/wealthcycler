@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> New Testimony </h4>
            </div>
            <div class="card-body">

                {!! Form::open(['route' => 'testimonies:create']) !!}
                <div class="form-group">
                    {!! Form::label('user_id', 'User') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('testimony', 'Testimony') !!}
                    {!! Form::textarea('testimony', null, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', [ 1=> 'Published', '-1' => 'UnPublished'], null, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection
