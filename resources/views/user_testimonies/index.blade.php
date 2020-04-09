@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a class="pull-right" href="{{ route('user_testimonies:create') }}">Create Testimony </a>
                Testimonies
            </div>

            <div class="card-body">
                <table class="table ">
                    <thead>
                    <tr>
                        <td> Testimony </td>
                        <td>Created </td>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($testimonies) && !empty($testimonies))
                        @foreach($testimonies as $testimony)
                            <tr>
                                <td> {{ $testimony->testimony }} </td>
{{--
                                <td> {{ ($testimony->status) ? 'published' : 'Unpublished' }} </td>
--}}
                                <td> {{ $testimony->created_at }} </td>
                                {{--<td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('testimonies:edit', $testimony->id) }}">edit</a>
                                    --}}{{--<a href="javascript:;" class="btn btn-danger btn-sm"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to delete this testimony?');
                                           if (response) {
                                           document.getElementById('{{ $testimony['id'] }}').submit(); }"
                                    >
                                        Remove
                                    </a>
                                    <form id="{{ $testimony['id'] }}" action="{{ route('testimonies:delete', $testimony['id']) }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="delete">
                                        @csrf
                                    </form>--}}{{--
                                </td>--}}
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
