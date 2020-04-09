@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('leaders:create') }}">New Leader </a>
                <h4> Leaders </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Leader Name</th>
                        <th scope="col">State Name</th>
                        <th>Default</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($leaders)
                        @foreach($leaders as $leader)
                            <tr>
                                <td>{{ $leader->id }}</td>
                                <td>{{ $leader->user->name }}</td>
                                <td>{{ $leader->state->name }}</td>
                                <td>{{ ($leader->default_selection) ? 'Yes' : 'No' }}</td>
                                <td>{{ $leader->created_at }}</td>
                                <td>{{ $leader->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('leaders:edit', $leader->id) }}"> Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $leader['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $leader['id'] }}" action="{{ route('leaders:delete', $leader['id']) }}" method="POST" style="display: none;">
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
