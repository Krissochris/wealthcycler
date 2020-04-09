@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> New Testimony </h4>
            </div>
            <div class="card-body">

                {!! Form::open(['route' => 'user_testimonies:create']) !!}

                <div class="form-group">
                    {!! Form::label('testimony', 'Testimony') !!}
                    {!! Form::textarea('testimony', null, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>

                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection
