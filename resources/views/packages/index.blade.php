@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right btn btn-primary btn-sm" href="{{ route('packages:create') }}">Create Package </a>
                Dashboard
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Amount (in Dollar $)</td>
                        <td>Description</td>
                        <td>Entry Package</td>
                        <td>Auto Upgrade</td>
                        <td>Next Package</td>
                        <td>Created</td>
                        <td>Last Updated</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($packages) && !empty($packages))
                        @foreach($packages as $package)
                            <tr>
                                <td> {{ $package->id }} </td>
                                <td> {{ $package->name }} </td>
                                <td> ${{ $package->amount }} </td>
                                <td> {{ $package->description }} </td>
                                <td>
                                    @if($package->entry_package)
                                        <span class="text-success">Yes</span>
                                    @else
                                        <span class="text-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($package->auto_upgrade)
                                        <span class="text-success">Yes</span>
                                    @else
                                        <span class="text-danger">No</span>
                                    @endif
                                </td>
                                <td> {{ $package->next_package['name'] }} </td>
                                <td> {{ $package->created_at }} </td>
                                <td> {{ $package->updated_at }} </td>
                                <td>
                                    <a href="{{ route('packages:edit', $package->id) }}">edit</a> |
                                    <a href="{{ route('packages:view', $package->id) }}">view</a> |
                                    <a href="javascript:;" class="text-danger"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this package ?');
                                               if (response) {
                                               document.getElementById('{{ $package['id'] }}').submit(); }"
                                            >
                                        Remove
                                    </a>
                                    <form id="{{ $package['id'] }}" action="{{ route('packages:delete', $package['id']) }}" method="POST" style="display: none;">
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