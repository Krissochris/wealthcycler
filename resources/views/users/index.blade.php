@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right" href="{{ route('users:create') }}">Create User </a>
                Users
            </div>

            <div class="card-body">
                <table class="table table-responsive" id="data-table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Username</td>
                        <td> Saving Wallet </td>
                        <td> Virtual Wallet </td>
                        <td> Dividend Wallet </td>
                        <td> is Pro member </td>
                        <td> Status </td>
                        <td>Created </td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($users) && !empty($users))
                        @foreach($users as $user)
                            <tr>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->username }} </td>
                                <td> ${{ number_format($user->saving_wallet->amount, 2) }} </td>
                                <td> ${{ number_format($user->virtual_wallet->amount, 2) }} </td>

                                <td>
                                    @if (isset($user->dividend_wallet))
                                        ${{ number_format($user->dividend_wallet->balance, 2) }}
                                        <br>
                                        <small>
                                            @if ((int)$user->dividend_wallet->status === 1)
                                                <i class="fa fa-check text-success"></i>
                                            @elseif ((int)$user->dividend_wallet->status === -1)
                                                <i class="fa fa-times text-danger"></i>
                                            @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_pro_member)
                                        <span class="text-success">Yes</span>
                                    @else
                                        <span class="text-danger">No</span>
                                @endif
                                <td>
                                    @switch($user->status)
                                    @case(1)
                                    <span class="text-success">active</span>
                                    @break
                                    @case(0)
                                    <span class="text-success">unactive</span>
                                    @break
                                    @case(-1)
                                    <span class="text-danger"> blocked </span>
                                    @break
                                    @default
                                    <span class="text-info">unknown</span>
                                    @endswitch
                                </td>
                                <td> {{ $user->created_at }} </td>
                                <td>
                                    @can('access_users_wallets')
                                    <a class="btn btn-primary btn-sm" href="{{ route('user_wallets:index', $user->id) }}">wallets</a>
                                    @endcan

                                    @can('edit_user')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users:edit', $user->id) }}">edit</a>
                                    @endcan

                                    @can('show_user')
                                    <a class="btn btn-info btn-sm" href="{{ route('users:view', $user->id) }}">view</a>
                                    @endcan

                                    @can('delete_user')
                                    <a href="javascript:;" class="btn btn-danger btn-sm"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this user ?');
                                               if (response) {
                                               document.getElementById('{{ $user['id'] }}').submit(); }"
                                            >
                                        Remove
                                    </a>
                                    <form id="{{ $user['id'] }}" action="{{ route('users:delete', $user['id']) }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="delete">
                                        @csrf
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
