@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('faqs:create') }}">New Faq</a>
                <h4> Frequently Asked Questions </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($faqs)
                        @foreach($faqs as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td>{{ $faq->status }}</td>
                                <td>{{ $faq->order }}</td>
                                <td>{{ $faq->created_at }}</td>
                                <td>{{ $faq->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('faqs:edit', $faq->id) }}"> Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to delete this record ?');
                                           if (response) {
                                           document.getElementById('{{ $faq['id'] }}').submit(); }"
                                    >Delete </a>
                                    <form id="{{ $faq['id'] }}" action="{{ route('faqs:delete', $faq['id']) }}" method="POST" style="display: none;">
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
