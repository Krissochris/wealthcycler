@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Role </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'roles:store']) !!}
                        <div class="form-group">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
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
