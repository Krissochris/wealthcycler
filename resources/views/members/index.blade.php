@extends('layouts.frontend')


@section('content')
    <div class="container">
        <h2 class="text-center"> Our Members </h2>

        <div class="row py-5">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name </th>
                        <th>Registered</th>
                    </tr>
                    </thead>
                    @foreach( $members as $member)
                        <tr>
                            <td> {{ $member->name }} </td>
                            <td> {{ $member->created_at }} </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="text-center">
                <a href="#"> View all members </a>
            </div>
        </div>
    </div>
@endsection
