@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Pages
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td> Page </td>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($pages) && !empty($pages))
                                @foreach($pages as $link => $page)
                                    <tr>
                                        <td> {{ $page }} </td>
                                        <td>
                                            <a href="{{ route('pages:edit', $link) }}">edit</a>
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
