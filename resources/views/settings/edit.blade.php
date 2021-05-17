@extends("layouts.app")

@section("title")
    Site Settings
@stop



@section("content")
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4> Site Settings </h4>
            </div>
            <div class="card-body">


                {!! Form::open(['route' => 'site_settings:edit']) !!}

                <div class="form-group">
                    {!! Form::label('membership_price', 'Membership Price') !!}
                    {!! Form::number('membership_price', setting('membership_price'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.name', 'App Name') !!}
                    {!! Form::text('app.name', setting('app_name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.slogan', 'Slogan') !!}
                    {!! Form::text('app.slogan', setting('app_slogan'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.company_mobile_1', 'App Company Mobile 1') !!}
                    {!! Form::text('app.company_mobile_1', setting('app_company_mobile_1'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_2', 'App Company Mobile 2') !!}
                    {!! Form::text('app.company_mobile_2', setting('app_company_mobile_2'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_3', 'App Company Mobile 3') !!}
                    {!! Form::text('app.company_mobile_3', setting('app_company_mobile_3'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_4', 'App Company Mobile 4') !!}
                    {!! Form::text('app.company_mobile_4', setting('app_company_mobile_4'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_5', 'App Company Mobile 5') !!}
                    {!! Form::text('app.company_mobile_5', setting('app_company_mobile_5'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_6', 'App Company Mobile 6') !!}
                    {!! Form::text('app.company_mobile_6', setting('app_company_mobile_6'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_7', 'App Company Mobile 7') !!}
                    {!! Form::text('app.company_mobile_7', setting('app_company_mobile_7'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_8', 'App Company Mobile 8') !!}
                    {!! Form::text('app.company_mobile_8', setting('app_company_mobile_8'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_9', 'App Company Mobile 9') !!}
                    {!! Form::text('app.company_mobile_9', setting('app_company_mobile_9'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_mobile_10', 'App Company Mobile 10') !!}
                    {!! Form::text('app.company_mobile_10', setting('app_company_mobile_10'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.company_email_1', 'App Company Email 1') !!}
                    {!! Form::text('app.company_email_1', setting('app_company_email_1'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.company_email_2', 'App Company Email 2') !!}
                    {!! Form::text('app.company_email_2', setting('app_company_email_2'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.company_email_3', 'App Company Email 3') !!}
                    {!! Form::text('app.company_email_3', setting('app_company_email_3'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('app.company_email_4', 'App Company Email 4') !!}
                    {!! Form::text('app.company_email_4', setting('app_company_email_4'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_5', 'App Company Email 5') !!}
                    {!! Form::text('app.company_email_5', setting('app_company_email_5'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_6', 'App Company Email 6') !!}
                    {!! Form::text('app.company_email_6', setting('app_company_email_6'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_7', 'App Company Email 7') !!}
                    {!! Form::text('app.company_email_7', setting('app_company_email_7'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_8', 'App Company Email 8') !!}
                    {!! Form::text('app.company_email_8', setting('app_company_email_8'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_9', 'App Company Email 9') !!}
                    {!! Form::text('app.company_email_9', setting('app_company_email_9'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('app.company_email_10', 'App Company Email 10') !!}
                    {!! Form::text('app.company_email_10', setting('app_company_email_10'), ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('app_address', 'Address') !!}
                    {!! Form::textarea('app_address', setting('app_address'), ['rows' => 4, 'class' => 'form-control'] ) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('about_us', 'About Us') !!}
                    {!! Form::textarea('app.about_us', setting('app_about_us'), ['class' => 'form-control', 'id'=>'editor'] ) !!}
                </div>

                <div class="mt-5">
                    <h4> Social Media Links</h4>
                    <div class="form-group">
                        {!! Form::label('app_facebook_url', 'FaceBook Url') !!}
                        {!! Form::text('app_facebook_url', setting('app_facebook_url'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('app_twitter_url', 'Twitter Url') !!}
                        {!! Form::text('app_twitter_url', setting('app_twitter_url'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('app_linkedIn_url', 'LinkedIn Url') !!}
                        {!! Form::text('app_linkedIn_url', setting('app_linkedIn_url'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('app_youtube_url', 'Youtube Url') !!}
                        {!! Form::text('app_youtube_url', setting('app_youtube_url'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('app_instagram_url', 'Instagram Url') !!}
                        {!! Form::text('app_instagram_url', setting('app_instagram_url'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('app_telegram_url', 'Telegram Url') !!}
                        {!! Form::text('app_telegram_url', setting('app_telegram_url'), ['class' => 'form-control']) !!}
                    </div>
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
