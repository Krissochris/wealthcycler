@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Virtual Merges
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Provide Donation User</td>
                        <td> Get Donation User </td>
                        <td> Amount in USD ($) </td>
                        <td> Status </td>
                        <td>Created</td>
                        <td>Last Updated</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($virtualMerges) && !empty($virtualMerges))
                        @foreach($virtualMerges as $virtualMerge)
                            <tr>
                                <td> {{ $virtualMerge->id }} </td>
                                <td> {{ $virtualMerge->provide_donation->user->name }} </td>
                                <td> {{ $virtualMerge->get_donation->user->name }} </td>
                                <td> ${{ $virtualMerge->amount }} </td>
                                <td> {{ $virtualMerge->status }} </td>
                                <td> {{ $virtualMerge->created_at }} </td>
                                <td> {{ $virtualMerge->updated_at }} </td>
                                <td>
                                    <a href="{{ route('virtual_merges:edit', $virtualMerge->id) }}">edit</a> |
                                    <a href="javascript:;" class="text-danger"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this virtual merge record?');
                                               if (response) {
                                               document.getElementById('{{ $virtualMerge['id'] }}').submit(); }"
                                            >
                                        Remove
                                    </a>
                                    <form id="{{ $virtualMerge['id'] }}" action="{{ route('virtual_merges:delete', $virtualMerge['id']) }}" method="POST" style="display: none;">
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