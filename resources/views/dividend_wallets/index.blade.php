@extends('layouts.app')

@section('title')
    Dividend Wallets
@stop

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0">Dividend Wallet</h4>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Is Active</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Event</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dividend_wallets as $wallet)
                        <tr>
                            <td>{{ $wallet->user->name }}</td>
                            <td>{{ ($wallet->is_active) ? 'active' : 'inactive' }}</td>
                            <td>${{ number_format($wallet->balance, 2) }}</td>
                            <td>
                                @if ((int)$wallet->status === 1)
                                    <span class="text-success">OK</span>
                                @elseif ((int)$wallet->status === -1)
                                    <span class="text-danger">Suspended</span>
                                @endif
                            </td>
                            <td></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('dividend_wallets:edit', $wallet->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
