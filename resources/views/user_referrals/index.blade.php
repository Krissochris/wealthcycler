@extends('layouts.app')


@section('content')
    <div class="col-lg-12">
        <div class="alert  alert-info" role="alert">
            <span class="badge badge-pill badge-info">Info</span>
            You referral link : {{ url()->to('/register') }}?ref={{ auth()->user()->username }}

        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="card-title mb-0"> My Referrals </h4>
                    </div>

                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Is pro member</th>
                        <th scope="col">Registered On</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $num = 1; ?>
                    @foreach($referrals as $referral)
                        <tr>
                            <th scope="row">{{ $num }} </th>
                            <td> {{ @$referral->referred_user->name }}</td>
                            <td> {{ ($referral->referred_user->is_pro_member) ? 'Yes' : 'No' }}</td>
                            <td> {{ $referral->created_at }}</td>
                        </tr>
                        <?php $num++; ?>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
