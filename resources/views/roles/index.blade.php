@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="pull-right" href="{{ route('roles:create') }}">Create Role </a>
                        Roles
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                                <td>Created </td>
                                <td>Last Updated</td>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($roles) && !empty($roles))
                                @foreach($roles as $role)
                                    <tr>
                                        <td> {{ $role->id }} </td>
                                        <td> {{ $role->name }} </td>
                                        <td> {{ $role->created_at }} </td>
                                        <td> {{ $role->updated_at }} </td>
                                        <td>
                                            <a href="{{ route('roles:edit', $role->id) }}">edit</a> |
                                            <a href="{{ route('roles:view', $role->id) }}">view</a> |
                                            <a href="javascript:;" class="text-danger"
                                               onclick="event.preventDefault();
                                                       var response = confirm('Are you sure you want to delete this role ?');
                                                       if (response) {
                                                       document.getElementById('{{ $role['id'] }}').submit(); }"
                                                    >
                                                Remove
                                            </a>
                                            <form id="{{ $role['id'] }}" action="{{ route('roles:delete', $role['id']) }}" method="POST" style="display: none;">
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
        </div>
    </div>
@endsection
