@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4> View Coordinator </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th> Name  </th>
                        <td> {{ $coordinator->user->name }} </td>
                    </tr>
                    <tr>
                        <th> State </th>
                        <td> {{ $coordinator->state->name }}</td>
                    </tr>
                </table>

                <h5> Leaders </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Leader Name</th>
                            <th> is default ?</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($leaders)
                        @foreach($leaders as $leader)
                            <tr>
                                <td>{{ $leader->user->name }}</td>
                                <td>{{ ($leader->default_selection) ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
