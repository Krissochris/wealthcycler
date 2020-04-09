@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Country </h4>
            </div>
            <div class="card-body">

                {!! Form::model( $country,['route' => ['countries:update', $country->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('country_code', 'Country Code') !!}
                    {!! Form::text('iso_3166_2', null, ['class' => 'form-control', 'maxlength' => 2]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('default_selection', 'Default') !!}

                    <input type="hidden" name="default_selection" value="0">
                    <label for="default_selection">
                        <input type="checkbox" name="default_selection" id="default_selection" value="1"
                        <?= ($country->default_selection) ? 'checked="checked"' : '' ?>>
                    </label>
                </div>
                <div>
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>

@endsection
