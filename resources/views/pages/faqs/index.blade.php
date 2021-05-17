@extends('layouts.frontend')

@section('content')
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper" style="background-image:url({{ asset('assets/images/banner/faq-banner.jpg') }});">
            <div class="overlay-main bg-black opacity-07"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <h1 class="text-white">Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

        <!-- BREADCRUMB ROW -->
        <div class="bg-gray-light p-tb20">
            <div class="container">
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li>Frequently Asked Questions </li>
                </ul>
            </div>
        </div>
        <!-- BREADCRUMB ROW END -->

        <!-- SECTION CONTENT -->
        <div class="section-full p-t80 p-b50">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <!-- TITLE  START -->
                        <div class="p-b30">
                            <h2 class="text-uppercase">FAQ</h2>
                            <div class="wt-separator-outer">
                                <div class="wt-separator bg-primary"></div>
                            </div>
                        </div>
                        <!-- TITLE START -->

                        <!-- ACCORDION START -->
                        <div class="wt-accordion acc-bg-gray" id="accordion5">
                            @if($faqs)
                                @foreach($faqs as $faq)
                                    <div class="panel wt-panel">
                                        <div class="acod-head acc-actives">
                                            <h3 class="acod-title">
                                                <a data-toggle="collapse" href="#collapseOne5" data-parent="#accordion5" >
                                                    {{ $faq->question }}
                                                    <span class="indicator"><i class="fa fa-plus"></i></span>
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="collapseOne5" class="acod-body collapse in">
                                            <div class="acod-content p-tb15">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                        <!-- ACCORDION END -->
                    </div>
                    <div class="col-md-3 col-sm-3 p-tb15">
                        <!-- BROCHURES -->
                        <div class="wt-box m-b30">

                        </div>

                        <!-- CONTACT US -->
                        <div class="widget bg-white  widget_getintuch">
                            <h4 class="widget-title">Contact us</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i><strong>Address</strong> {{ setting('app_address') }}</li>
                                <li><i class="fa fa-phone"></i><strong>phone</strong> {{ setting('app_company_mobile_1') }} (SUPPORT 24/7)</li>
                                <li><i class="fa fa-envelope"></i><strong>email</strong> {{ setting('app_company_email_1') }} </li>
                                <li><i class="fa fa-envelope"></i><strong>email</strong> {{ setting('app_company_email_1') }} </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- SECTION CONTENT END -->

    </div>
@endsection
