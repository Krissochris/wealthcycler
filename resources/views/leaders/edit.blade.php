@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Edit Leader </h4>
            </div>
            <div class="card-body">

                {!! Form::model($leader, ['route' => ['leaders:update', $leader->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('user_id', 'User') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('default_selection', 'Default') !!}

                    <input type="hidden" name="default_selection" value="0">
                    <label for="default_selection">
                        <input type="checkbox" name="default_selection" id="default_selection" value="1"
                        <?= ($leader->default_selection) ? 'checked="checked"' : '' ?>>
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