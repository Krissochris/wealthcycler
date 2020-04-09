@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('currencies:create') }}">New Currency</a>
               <h4> Currencies </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($currencies)
                        @foreach($currencies as $currency)
                            <tr>
                                <td>{{ $currency->id }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->created_at }}</td>
                                <td>{{ $currency->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('currencies:edit', $currency->id) }}"> Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $currency['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $currency['id'] }}" action="{{ route('currencies:delete', $currency['id']) }}" method="POST" style="display: none;">
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