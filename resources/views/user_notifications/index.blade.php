@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Notifications
            </div>

            <div class="card-body">
                <table class="table ">
                    <thead>
                    <tr>

                        <td> Log </td>
                        <td>Created </td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($notifications) && !empty($notifications))
                        @foreach($notifications as $notification)
                            <tr>
                                <td> {{ $notification->description }} </td>
                                <td> {{ $notification->created_at }} </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
