@extends('layouts.app')

@section('content')
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right btn btn-primary btn-sm" href="{{ route('get_donations:create') }}">Get Provide Donation </a>
                Get Donations
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td> Package </td>
                        <td> Amount in USD ($) </td>
                        <td> Status </td>
                        <td>Created</td>
                        <td>Last Updated</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($getDonations) && !empty($getDonations))
                        @foreach($getDonations as $getDonation)
                            <tr>
                                <td> {{ $getDonation->id }} </td>
                                <td> {{ $getDonation->user->name }} </td>
                                <td> {{ $getDonation->package->name }} </td>
                                <td> ${{ $getDonation->amount }} </td>
                                <td> {{ $getDonation->status }} </td>
                                <td> {{ $getDonation->created_at }} </td>
                                <td> {{ $getDonation->updated_at }} </td>
                                <td>
                                    <a href="{{ route('get_donations:edit', $getDonation->id) }}">edit</a> |
                                    <a href="javascript:;" class="text-danger"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this get donation ?');
                                               if (response) {
                                               document.getElementById('{{ $getDonation['id'] }}').submit(); }"
                                            >
                                        Remove
                                    </a>
                                    <form id="{{ $getDonation['id'] }}" action="{{ route('get_donations:delete', $getDonation['id']) }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="delete">
                                        @csrf
                                    </form>
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