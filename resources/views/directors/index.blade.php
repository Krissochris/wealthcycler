@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('directors:create') }}">New Director </a>
                <h4> Directors </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Director Name</th>
                        <th scope="col"> Title </th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if ($directors)
                        @foreach($directors as $director)
                            <tr>
                                <td>{{ $director->id }}</td>
                                <td>{{ $director->user->name }}</td>
                                <td>{{ $director->title }}</td>
                                <td>{{ $director->created_at }}</td>
                                <td>{{ $director->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('directors:edit', $director->id) }}"> Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $director['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $director['id'] }}" action="{{ route('directors:delete', $director['id']) }}" method="POST" style="display: none;">
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