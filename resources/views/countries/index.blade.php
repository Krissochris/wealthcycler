@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm float-right" href="{{ route('countries:create') }}">New Country</a>
                <h4> Countries </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Country Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Default</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($countries)
                        @foreach($countries as $country)
                            <tr>
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->iso_3166_2 }}</td>
                                <td>{{ $country->name }}</td>
                                <td>{{ ($country->default_selection) ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('countries:edit', $country->id) }}">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to delete this country?');
                                           if (response) {
                                           document.getElementById('{{ $country['id'] }}').submit(); }"

                                    >Remove</a>
                                    <form id="{{ $country['id'] }}" action="{{ route('countries:delete', $country['id']) }}" method="POST" style="display: none;">
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
