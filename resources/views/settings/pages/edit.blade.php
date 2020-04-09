@extends("layouts.app")

@section("title")
    Site Settings
@stop



@section("content")
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4> {{ $page }} </h4>
            </div>
            <div class="card-body">


                {!! Form::open(['route' => ['pages:edit', $page] ]) !!}


                <div class="form-group">
                    {!! Form::label($page, $page) !!}
                    {!! Form::textarea($page, setting($page), ['class' => 'form-control', 'id'=>'editor'] ) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit',['class'=> 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop
