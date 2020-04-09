@extends('layouts.app')

@section('content')
    <div class="col-lg- col-sm-12">
        <div class="card">
            <div class="card-header">Edit User</div>

            <div class="card-body">
                {!! Form::model($user, ['route' => ['users:update', $user->id], 'method' => 'PUT' ]) !!}
                <div class="form-group">
                    {!! Form::label('Name') !!}
                    {!! Form::text('name',null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone_number', 'Phone Number') !!}
                    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::label('city') !!}
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('state_id', 'State') !!}
                    {!! Form::select('state_id', $states,null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id', 'Country') !!}
                    {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('is_pro_member', 'Is Pro Member') !!}
                    <input type="hidden" name="is_pro_member" value="0">
                    <label for="is_pro_member">
                        <input type="checkbox" name="is_pro_member" id="is_pro_member" value="1"
                        <?= ($user->is_pro_member) ? 'checked="checked"' : '' ?>    >
                    </label>
                </div>

                <div class="form-group">
                    {!! Form::label('email_verified_at', 'Email verified') !!}
                    <input type="hidden" name="email_verified_at" value="0">
                    <label for="email_verified_at">
                        <input type="checkbox" name="email_verified_at" id="email_verified_at" value="1" <?= ($user->email_verified_at) ? 'checked="checked"' : '' ?> >
                    </label>
                </div>

                <div class="form-group">
                    {!! Form::label('override_virtual_withdrawal_restriction', 'Override Virtual Withdrawal Restriction') !!}
                    <input type="hidden" name="override_virtual_withdrawal_restriction" value="0">
                    <label for="override_virtual_withdrawal_restriction">
                        <input type="checkbox" name="override_virtual_withdrawal_restriction" id="override_virtual_withdrawal_restriction" value="1" <?= ($user->override_virtual_withdrawal_restriction) ? 'checked="checked"' : '' ?> >
                    </label>
                </div>

                <div class="form-group">
                    {!! Form::label('override_referral_limit_in_virtual_transfer', 'Override Referral Limit in Virtual Transfer') !!}
                    <input type="hidden" name="override_referral_limit_in_virtual_transfer" value="0">
                    <label for="override_referral_limit_in_virtual_transfer">
                        <input type="checkbox" name="override_referral_limit_in_virtual_transfer"
                               id="override_referral_limit_in_virtual_transfer" value="1"
                        <?= ($user->override_referral_limit_in_virtual_transfer) ? 'checked="checked"' : '' ?> >
                    </label>
                </div>


                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $userStatus, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('roles', 'Roles') !!}
                    {!! Form::select('roles[]', $roles, $userRoles, ['class' => 'form-control', 'multiple' => true]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('current_virtual_package_id', 'Current Package') !!}
                    {!! Form::select('current_virtual_package_id', $packages, $user->current_virtual_package_id, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="card">
            <div class="card-header">User Permissions </div>
            <div class="card-body">
                {!! Form::open(['route' => ['users:update_permissions', $user->id] ]) !!}

                <div class="form-group mt-4">

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


        <div class="card">
            <div class="card-header"> Subscribe user to package</div>

            <div class="card-body">
                {!! Form::open(['route' =>'users:subscribeToPackage']) !!}

                {!! Form::hidden('user_id', $user->id) !!}
                <div class="form-group">
                    {!! Form::label('package_id', 'Current Package') !!}
                    {!! Form::select('package_id', $packages, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::button('submit', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
