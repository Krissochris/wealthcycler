@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Role </div>

                    <div class="card-body">
                        {!! Form::model($role, ['route' => ['roles:update', $role->id], 'method' => 'PUT' ]) !!}
                        <div class="form-group">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group mt-4">
                            {!! Form::label('permissions', 'Role Permissions') !!}

                            @foreach($permissions as $package => $permission)
                                <div class="mt-4">
                                    <p> {{ ucfirst($package) }} </p>
                                    @foreach($permission as $each)
                                        <label for="{{ $each }}">
                                            <input id="{{ $each }}" type="checkbox" name="permissions[]" value="{{ $each }}"
                                            @if(in_array($each, $rolePermissions)) checked @endif
                                            > {{ $each }}
                                        </label>
                                    @endforeach
                                </div>

                            @endforeach
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
