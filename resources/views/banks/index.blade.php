@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('banks:create') }}"> Add Bank </a>
                <h4> Banks </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($banks)
                        @foreach($banks as $bank)
                            <tr>
                                <td>{{ $bank->id }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->created_at }}</td>
                                <td>{{ $bank->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('banks:edit', $bank->id) }}"> Edit </a>
                                    <a class="btn btn-danger btn-sm" href="#"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to delete this record ?');
                                           if (response) {
                                           document.getElementById('{{ $bank['id'] }}').submit(); }"
                                    >Delete </a>
                                    <form id="{{ $bank['id'] }}" action="{{ route('banks:delete', $bank['id']) }}" method="POST" style="display: none;">
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
