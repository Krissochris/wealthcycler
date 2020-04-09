@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('coordinators:create') }}">New Coordinator </a>
                <h4> Coordinators </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coordinator Name</th>
                        <th scope="col"> State </th>
                        <th scope="col"> Director </th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($coordinators)
                        @foreach($coordinators as $coordinator)
                            <tr>
                                <td>{{ $coordinator->id }}</td>
                                <td>{{ $coordinator->user->name }}</td>
                                <td>{{ $coordinator->state->name }}</td>
                                <td>{{ $coordinator->director->user->name }} - {{$coordinator->director->title}}</td>
                                <td>{{ $coordinator->created_at }}</td>
                                <td>{{ $coordinator->updated_at }}</td>
                                <td>
                                    <a class="text-info" href="{{ route('coordinators:view', $coordinator->id) }}"> View </a>

                                    <a class="text-primary" href="{{ route('coordinators:edit', $coordinator->id) }}"> Edit </a>
                                    <a class="text-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $coordinator['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $coordinator['id'] }}" action="{{ route('coordinators:delete', $coordinator['id']) }}" method="POST" style="display: none;">
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
