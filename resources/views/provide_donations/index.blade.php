@extends('layouts.app')

@section('content')
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right btn btn-primary btn-sm" href="{{ route('provide_donations:create') }}">Create Provide Donation </a>
                Provide Donations
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
                    @if (isset($provideDonations) && !empty($provideDonations))
                        @foreach($provideDonations as $provideDonation)
                            <tr>
                                <td> {{ $provideDonation->id }} </td>
                                <td> {{ $provideDonation->user->name }} </td>
                                <td> {{ $provideDonation->package->name }} </td>
                                <td> ${{ $provideDonation->amount }} </td>
                                <td> {{ $provideDonation->status }} </td>
                                <td> {{ $provideDonation->created_at }} </td>
                                <td> {{ $provideDonation->updated_at }} </td>
                                <td>
                                    <a href="{{ route('provide_donations:edit', $provideDonation->id) }}">edit</a> |
                                    <a href="javascript:;" class="text-danger"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this provide donation ?');
                                               if (response) {
                                               document.getElementById('{{ $provideDonation['id'] }}').submit(); }"
                                            >
                                        Remove
                                    </a>
                                    <form id="{{ $provideDonation['id'] }}" action="{{ route('provide_donations:delete', $provideDonation['id']) }}" method="POST" style="display: none;">
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