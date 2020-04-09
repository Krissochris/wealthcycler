@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> Maintenance Fee Logs </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Package</th>
                        <th>User </th>
                        <th>Get Donation </th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($maintenanceFees)
                        @foreach($maintenanceFees as $maintenanceFee)
                            <tr>
                                <td></td>
                                <td>{{ $maintenanceFee->user->name }}</td>
                                <td>{{ $maintenanceFee->package->name }}</td>
                                <td>{{ $maintenanceFee->user->name }}</td>
                                <td>{{ number_format($maintenanceFee->amount, 2) }}</td>
                                <td>{{ $maintenanceFee->created_at }}</td>
                                <td>{{ $maintenanceFee->updated_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
