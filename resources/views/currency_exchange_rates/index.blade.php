@extends('layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-sm pull-right" href="{{ route('currency_exchange_rates:create') }}">New Currency Exchange Rate</a>
                <h4> Currency Exchange Rates </h4>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($currency_exchange_rates)
                        @foreach($currency_exchange_rates as $currency_exchange_rate)
                            <tr>
                                <td>{{ $currency_exchange_rate->id }}</td>
                                <td>{{ $currency_exchange_rate->rate }}</td>
                                <td>{{ $currency_exchange_rate->currency->code }}</td>
                                <td>{{ $currency_exchange_rate->created_at }}</td>
                                <td>{{ $currency_exchange_rate->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('currency_exchange_rates:edit', $currency_exchange_rate->id) }}">Edit </a>
                                    <a class="btn btn-danger" href="#"
                                       onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this record ?');
                                               if (response) {
                                               document.getElementById('{{ $currency_exchange_rate['id'] }}').submit(); }"
                                            >Delete </a>
                                    <form id="{{ $currency_exchange_rate['id'] }}" action="{{ route('currency_exchange_rates:delete', $currency_exchange_rate['id']) }}" method="POST" style="display: none;">
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