@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('states:create') }}">New State</a>
                <h4> States </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col"> Country </th>
                        <th scope="col">Country Code</th>
                        <th scope="col"> Default </th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($states)
                        @foreach($states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td>{{ $state->name }}</td>
                                <td>{{ $state->country->name }}</td>
                                <td>{{ $state->country_code }}</td>
                                <td>{{ ($state->default_selection) ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('states:edit', $state->id) }}"> Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $state['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $state['id'] }}" action="{{ route('states:delete', $state['id']) }}" method="POST" style="display: none;">
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
