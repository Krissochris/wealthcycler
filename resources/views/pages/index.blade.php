<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ setting('app_meta_description') }} "/>
    <!-- SITE TITLE -->
    <title> {{ setting('app_name') }} >> Setting the Standard : Homepage
    </title>

<!-- [if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif] -->

    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}">


    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- FONTAWESOME STYLE SHEET -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flaticon.min.css') }}">
    <!-- ANIMATE STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}">
    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/loader.min.css') }}">
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- THEME COLOR CHANGE STYLE SHEET -->
    <link rel="stylesheet" class="skin" type="text/css" href="{{ asset('assets/css/skin/skin-1.css') }}">
    <!-- CUSTOM  STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <!-- SIDE SWITCHER STYLE SHEET -->


    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/revolution/revolution/css/settings.css') }}">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/plugins/revolution/revolution/css/navigation.css') }}">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet">
</head>


<body id="bg">
@include('flash::message')
@include('element.flash.error')
<div class="page-wraper">
    <!-- HEADER START -->
    <header class="site-header header-style-3 topbar-transparent">
        <div class="top-bar">
            <div class="container">
                <div class="row">

                    <div class="clearfix">


                        <div class="wt-topbar-left">
                            <ul class="list-unstyled e-p-bx pull-left">
                                <li><i class="fa fa-envelope"></i>{{ setting('app_company_email_1') }}</li>
                                <li><i class="fa fa-phone"></i> {{ setting('app_company_mobile_1') }}</li>
                            </ul>
                        </div>

                        <div class="wt-topbar-right">
                            <div class=" language-select pull-right">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Language
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><img src="{{ asset('assets/images/united-states.png') }}" alt="">English</a></li>

                                    </ul>
                                </div>
                            </div>

                            <ul class="list-unstyled e-p-bx pull-right">
                                <li><a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a>
                                </li>
                                <li><a href="{{ route('register') }}"><i class="fa fa-sign-in"></i>Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-header main-bar-wraper">
            <div class="main-bar">
                <div class="container">

                    <div class="logo-header mostion">
                        <a href="/">
                            <img src="{{ asset('assets/images/logo-white-xs.png') }}" width="230" height="67" alt=""/>
                        </a>
                    </div>

                    <!-- NAV Toggle Button -->
                    <button data-target=".header-nav" data-toggle="collapse" type="button"
                            class="navbar-toggle collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <!-- ETRA Nav -->



                    <!-- MAIN Vav -->
                    <div class="header-nav navbar-collapse collapse ">
                        <ul class=" nav navbar-nav">
                            <li class="active">
                                <a href="/">Home</a>
                            </li>

                            <li>
                                <a href="{{ route('pages:view', 'page_about_us') }}">About Us</a>

                            </li>

                            <li>
                                <a href="{{ route('pages:view', 'page_contact_us') }}">Contact Us</a>
                            </li>

                            <li>
                                <a href="/faqs">FAQ</a>
                            </li>
                            <li><a href="{{ route('pages:view', 'page_become_an_affiliate') }}">Become An Affiliate</a></li>
                            <li><a href="{{ route('pages:view', 'page_values_to_expect') }}">Values To Expect</a></li>

                            <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </header>
    <!-- HEADER END -->

    <!-- CONTENT START -->
    <div class="page-content">
        <!-- SLIDER START -->
        @include('layouts.frontend.slider.index')
        <!-- SLIDER END -->

        <!-- MARQUEE SCROLL -->

        <!-- MARQUEE SCROLL SECTION  END -->

        <!-- ABOUT COMPANY SECTION START -->
        <div class="section-full home-about-section p-t80 bg-no-repeat bg-bottom-right">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="wt-box text-right">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/91-KB9pLitc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wt-right-part p-b80">
                            <!-- TITLE START -->
                            <div class="section-head text-left">

                                <h2 class="text-uppercase"> WHO WE ARE</h2>

                                <div class="wt-separator-outer">
                                    <div class="wt-separator bg-primary"></div>
                                </div>
                            </div>
                            <!-- TITLE END -->
                            <div class="section-content">
                                <div class="wt-box">
                                    <div class="mb-5">
                                        {!! setting('app_about_us') !!}
                                    </div>

                                    <br>
                                    <p>
                                        SLOGAN: <br>
                                        <strong> {{ setting('app_slogan') }} </strong>
                                    </p>

                                    <a href="{{ route('pages:view', 'page_contact_us') }}" class="site-button-secondry text-uppercase">Contact us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ABOUT COMPANY SECTION  END -->

        <!-- WHY CHOOSE US SECTION START  -->
        <div class="section-full  p-t80 p-b80 bg-gray">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head text-center">
                    <h2 class="text-uppercase">WHAT WE DO</h2>

                    <div class="wt-separator-outer">
                        <div class="wt-separator bg-primary"></div>
                    </div>
                    <p>

                        We are here because we are passionate about
                        <strong>Community Growth, Peace, Love, Discipline and true Wealth creation</strong>.
                        We saw the need of creating a community that could function like a full fledged offline club in a global settings,
                        with robust online mobility and no age restrictions, and we made <strong>TYEN CLUB</strong>. Being a member of our club avails you the opportunity to help and be helped freely,
                        due to the mutual relationship we set as No.1 standard of operation among members.
                    </p>
                </div>
                <!-- TITLE END-->
                <div class="section-content">
                    <div class="row">

                        <!-- COLUMNS 1 -->
                        <div class="col-md-4 col-sm-12 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Social Engagements</h4>

                                    <p>
                                        With our club, you are sure of developing a high profiled social life from the numerous social activities we engage ourselves in. We also host an end-of-the-year gathering where we commune and also have fun with different social activities like football, tennis, volleyball, board games, Educational activities, Talent Shows, and many others.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 2 -->

                        <div class="col-md-4 col-sm-6 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content ">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Free Skill acquisition </h4>

                                    <p>
                                        Get Points that will grant you FREE ACCESS to unlimited professional skill training courses offered at TYEN Academy, worth above $1,000 and more. You will be required to pay for the certificates that will be issued to you by the company after training and be given FREE lifetime access to the course community.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="col-md-4 col-sm-6 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Earn passively with SECUREWILLS INVESTMENT LTD </h4>

                                    <p>
                                        Securewills Investment LTD with RC No.: 1735688 is a multidimensional investment company.
                                    </p>
                                    <p>
                                        At TYEN CLUB, we have given every youth (Young or old, Poor or Rich) the opportunity to acquire financial freedom through an investment plan so they wouldn't need to labor for returns with "SECUREWILLS INVESTMENT LTD". Hence, every member of TYEN CLUB will be paid $500 dividends annually by "The Young Creative Thinkers Initiative" for a lifetime. The payment is automated on an annual cycle, so you don't have to bother stressing about payouts.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- COLUMNS 4 -->
                        <div class="col-md-4 col-sm-6 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">FREE AUTO VFS SOFTWARE</h4>

<!--                                    <p>
                                        In the process of ensuring we make and fulfill our promises to our members,
                                        we launched a <strong>virtual finance system (VFS) for compounding savings</strong>.
                                        The VFS software is <strong>first of its kind</strong> and was programmed to raise a minimum of <strong>$500 dollars</strong>
                                        for every member of our club in 12months of membership. And in completion of 5years period
                                        program for each member, it should compound a <strong>minimum savings of about $500,000 to $1,000,000 dollars
                                            per member</strong>.
                                    </p>-->
                                    <p>
                                        In the process of ensuring we make and fulfill our promises to our members, we launched a virtual finance system (VFS) for compounding savings. The VFS software is the first of its kind and was programmed to compound a minimum of $500 dollars for every member of our club in 12months. And in completion of 5years period program for each member, it should compound a minimum savings of about $15,000 to $25,000 dollars per member.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 5 -->
                        <div class="col-md-4 col-sm-6 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Idea funding/Business Creation</h4>

                                    <p>
                                        Being a member of our club avails you the opportunity to have your dream idea funded by the club either with our interest-free loan or as a grant. It also grants you the opportunity to invest in co-members ideas, or buy shares in their virgin company, so while TYEN CLUB promotes and ensure the progressive growth of the new company, your shares/investment is already yielding dividends for you based on the percentage of shares you have in the company.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 6 -->
                        <div class="col-md-4 col-sm-6 animate_line">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Getting mutual donations</h4>

                                    <p>
                                        Part of the mutual activities we engage in the club is helping one another in raising funds to solve peculiar problems. And supporting members with jointly raised funds when they invite us to a seasonal celebration of their life like weddings, traditional marriage, and any other substantial celebration that should undoubtedly require the presence of the club.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- WHY CHOOSE US SECTION END -->

        <!-- COMPANY DETAIL SECTION START -->
        <div class="section-full p-t50 p-b50 overlay-wraper bg-parallax clouds1 bg-repeat"
             data-stellar-background-ratio="0.5" style="background-image:url({{ asset('assets/images/background/bg-9.jpg') }});">
            <div class="overlay-main bg-secondry opacity-05"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-4 col-sm-6">

                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="awesome-counter text-right text-white">
                            <h3 class="font-24">Facts About TYEN CLUB</h3>

                            <h2 class="font-60 font-weight-600"><span class="text-primary"> AWESOME FACTS</span></h2>

                            <p>Our club stats and transactions over the years.</p>
                        </div>
                        <div class="row">
                           <div class="col-md-4">

                           </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="status-marks  text-white m-tb10">
                                    <div class="status-value text-right">
                                        <span class="counter">{{ number_format($totalUsers) }} </span>
                                        <i class="fa fa-users font-26 m-l15"></i>
                                    </div>
                                    <h6 class="text-uppercase text-white text-right">ACTIVE MEMBERS</h6>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="status-marks  text-white m-tb10">
                                    <div class="status-value text-right">
                                        <span class="counter">175</span>
                                        <i class="fa fa-user-plus font-26 m-l15"></i>
                                    </div>
                                    <h6 class="text-uppercase text-white text-right">SUPPORTED COUNTRIES</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COMPANY DETAIL SECTION End -->

        <!-- HOW IT WORK SECTION START  -->
        <div class="section-full  p-t80 p-b80 bg-gray">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head text-center">
                    <span class="wt-title-subline font-16 text-gray-dark m-b15">GETTING STARTED WITH TYEN</span>

                    <h2 class="text-uppercase">How It Works</h2>

                    <div class="wt-separator-outer">
                        <div class="wt-separator bg-primary"></div>
                    </div>
                    <p>It’s easy, and takes only a few minutes!</p>
                </div>
                <!-- TITLE END-->
                <div class="section-content no-col-gap">
                    <div class="row">

                        <!-- COLUMNS 1 -->
                        <div class="col-md-4 col-sm-4 step-number-block">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
{{--
                                    <a href="#" class="icon-cell"><img src="{{ asset('assets/images/icon/pick-38.png') }}" alt=""></a>
--}}
                                </div>
                                <div class="icon-content">
                                    <div class="step-number">1</div>
                                    <h4 class="wt-tilte text-uppercase font-weight-500">Create your Account</h4>

                                    <p>
                                        Click on <strong>"SIGN UP"</strong> on top of the page.
                                        Fill in all the required data in the <strong>registration</strong> form and send.
                                        Then login to your email account to <strong>verify your account</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 2 -->
                        <div class="col-md-4 col-sm-4 step-number-block">
                            <div class="wt-icon-box-wraper  p-a30 center bg-secondry m-a5 ">
                                <div class="icon-lg m-b20">
                                </div>
                                <div class="icon-content text-white">
                                    <div class="step-number active">2</div>
                                    <h4 class="wt-tilte text-uppercase font-weight-500"> GO PRO (LIFETIME MEMBERSHIP) </h4>

                                    <p>
                                        <strong>Login</strong> to your account after successful verification.
                                        Then click upgrade to <strong>Pro membership</strong>.
                                        You will be prompted to pay a <strong>non-refundable fee of $100 for lifetime membership</strong>. Select any preferred payment options and Follow the on-screen prompts to complete your payment!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="col-md-4 col-sm-4 step-number-block">
                            <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                <div class="icon-lg text-primary m-b20">
                                </div>
                                <div class="icon-content">
                                    <div class="step-number">3</div>
                                    <h4 class="wt-tilte text-uppercase font-weight-500"> Become an active club member </h4>

                                    <p>
                                        Join the club's Activities, and bring in your friend's to do same.
                                        Build a <strong>long-term dream</strong> around with us and see us helping you actualize those dreams within few years of loyalty.
                                        <strong>This is our PROMISE!</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- HOW IT WORK  SECTION END -->

        <!-- OUR TEAM MEMBER SECTION START -->
        <div class="section-full text-center wt-our-team bg-gray p-t80 p-b50">
            <div class="container">

                <!-- TITTLE START -->
                <div class="section-head text-center">
                    <h2 class="text-uppercase">Our Team</h2>
                    <div class="wt-separator-outer">
                        <div class="wt-separator bg-primary"></div>
                    </div>
                </div>
                <!-- TITLE END -->

                <div class="section-content">
                    <div class="row">

                        @if (isset($teams) && !empty($teams))
                            @foreach($teams as $team)
                                <div class="col-md-4 col-sm-4  m-tb15">
                                    <div class="wt-team-one bg-white">
                                        <div class="wt-team-media">
                                            <a href="javascript:void(0);"><img src="{{ $team->photo }}" class="" alt="{{ $team->name }}"></a>
                                        </div>
                                        <div class="wt-team-info text-center bg-white p-a10">
                                            <h4 class="wt-team-title"><a href="javascript:void(0);"> {{ $team->name }} </a></h4>
                                            <p> {{ $team->position }} </p>
                                            {{--<ul class="social-icons social-square social-dark">
                                                <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                                                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                                                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                                                <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                                                <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                                                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                                            </ul>--}}
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                    </div>
                </div>

            </div>
        </div>


        <!-- OUR TEAM MEMBER SECTION END -->

        <!-- SECTION CONTENT START -->

        <!-- SECTION CONTENT  END -->

        <!-- LATEST BLOG SECTION START -->
    </div>
</div>
<!-- LATEST BLOG SECTION END -->

<!-- CONTACT US SECTION END  -->

<!-- CONTACT US OFFER SECTION END  -->

<!-- SECTION CONTENT START -->
<div class="section-full p-t80 p-b50 bg-center bg-full-height bg-no-repeat"
     style="background-image:url({{ asset('assets/images/background/bg-testimonial.jpg') }});">
    <div class="container">
        <!-- TITLE START -->
        <div class="section-head text-center">

            <h2 class="text-uppercase">What Our Members Say</h2>

            <div class="wt-separator-outer">
                <div class="wt-separator bg-primary"></div>
            </div>
        </div>
        <!-- TITLE END -->

        <!-- TESTIMONIAL 4 START ON BACKGROUND -->
        <div class="section-content">
            <div class="owl-carousel home-carousel-1">
                @foreach($testimonies as $testimony)
                        <div class="item">
                            <div class="testimonial-5">
                                <div class="testimonial-text clearfix">
                                    <div class="testimonial-paragraph">
                                        <span class="fa fa-quote-left text-primary"></span>

                                        <p>
                                            {{ $testimony->testimony }}
                                        </p>
                                    </div>
                                    <div class="testimonial-detail clearfix">
                                        <strong class="testimonial-name"> {{ @$testimony->user->name }} </strong>
                                    </div>
                                </div>

                            </div>
                        </div>

                @endforeach
            </div>
        </div>

    </div>
</div>
<!-- SECTION CONTENT END -->

<div class="section-full text-center wt-our-team bg-gray p-t80 p-b50">
    <div class="container">

        <!-- TITTLE START -->
        <div class="section-head text-center">
            <h2 class="text-uppercase">Our Latest Members</h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-primary"></div>
            </div>
        </div>
        <!-- TITLE END -->

        <div class="section-content">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name </th>
                            <th>Registered</th>
                        </tr>
                        </thead>
                        @foreach( $latestMembers as $member)
                            <tr>
                                <td> {{ $member->name }} </td>
                                <td> {{ $member->created_at->format('M j, Y \a\t g:i a')  }} </td>
                            </tr>
                        @endforeach

                    </table>
                    <div>
                        <a href="{{ route('members:index') }}"> View all members </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- CONTENT END -->
@include('layouts.frontend.footer.index')
