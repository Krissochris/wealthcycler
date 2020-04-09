@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        View User Package
                    </div>

                    <div class="card-body">
                        @if ($provide_donations)
                        <ul>
                            @foreach($provide_donations as $provide_donation)
                                <li>
                                    <h4> Provide Donation </h4>
                                    <p>
                                        Package Name : {{ $provide_donation->package->name }}
                                    </p>
                                    <p>
                                        Amount : {{ $provide_donation->package->amount }}
                                    </p>
                                    <p>
                                        status: {{ $provide_donation->status }}
                                    </p>
                                    <p>
                                        created on : {{ $provide_donation->created_at }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection