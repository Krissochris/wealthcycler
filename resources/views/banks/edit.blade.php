@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Bank </h4>
            </div>
            <div class="card-body">

                {!! Form::model($bank, ['route' => ['banks:edit', $bank->id] ]) !!}


                <div class="form-group">
                    {!! Form::label('name', 'Bank Name') !!}
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
