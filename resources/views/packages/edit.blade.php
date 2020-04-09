@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Package</div>

                    <div class="card-body">
                        {!! Form::model($package, ['route' => ['packages:update', $package->id], 'method' => 'PUT' ]) !!}
                        <div class="form-group">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name',null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('amount', 'Amount in dollar($)') !!}
                            {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('entry_package', 'Entry Package') !!}
                            <input type="hidden" name="entry_package" value="0">
                            <label for="entry_package">
                                <input type="checkbox" name="entry_package" id="entry_package" value="1"
                                <?= ($package->entry_package) ? 'checked="checked"' : '' ?>
                                        >
                            </label>
                        </div>

                        <div class="form-group">
                            {!! Form::label('auto_upgrade', 'Auto Upgrade') !!}
                            <input type="hidden" name="auto_upgrade" value="0">
                            <label for="auto_upgrade">
                                <input type="checkbox" name="auto_upgrade" id="auto_upgrade" value="1"
                                <?= ($package->auto_upgrade) ? 'checked="checked"' : '' ?>    >
                            </label>
                        </div>

                        <div class="form-group">
                            {!! Form::label('next_package_id', 'Next Package') !!}
                            {!! Form::select('next_package_id', $packages, null, ['class' => 'form-control' ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Status') !!}
                            <input type="hidden" name="status" value="0">
                            <label for="status">
                                <input type="checkbox" name="status" id="status" value="1" checked="checked" >
                            </label>
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