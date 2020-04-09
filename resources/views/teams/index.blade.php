@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right" href="{{ route('teams:create') }}">Create Member </a>
                Teams
            </div>

            <div class="card-body">
                <table class="table ">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td> Position </td>
                        <td> Photo </td>
                        <td>Created </td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($teams) && !empty($teams))
                        @foreach($teams as $team)
                            <tr>
                                <td> {{ $team->id }} </td>
                                <td> {{ $team->name }} </td>
                                <td> {{ $team->position }} </td>
                                <td><img src="{{ $team->photo }}" alt="{{ $team->name }}" width="100" height="100"> </td>
                                <td> {{ $team->created_at }} </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('teams:edit', $team->id) }}">edit</a>
                                    <a href="javascript:;" class="btn btn-danger btn-sm"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to delete this team?');
                                           if (response) {
                                           document.getElementById('{{ $team['id'] }}').submit(); }"
                                    >
                                        Remove
                                    </a>
                                    <form id="{{ $team['id'] }}" action="{{ route('teams:delete', $team['id']) }}" method="POST" style="display: none;">
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
