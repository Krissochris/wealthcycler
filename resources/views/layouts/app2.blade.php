<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ config('app.name') }} is an online minning Agencies for digital crypto currency as well as forex trading and investment."/>
    <!-- SITE TITLE -->
    <title> Home : {{ config('app.name', " ") }} </title>

<!-- [if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif] -->

    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">


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
    <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/switcher.css') }}">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet">
</head>


<body id="bg">

<div class="page-wraper">

    <!-- HEADER START -->
    <header class="site-header header-style-6">

        <div class="top-bar bg-primary">
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <div class="wt-topbar-left">
                            <ul class="list-unstyled e-p-bx pull-left">
                                <li><i class="fa fa-envelope"></i>support@expexfirst.com</li>
                                <li><i class="fa fa-phone"></i>+1 800-263-9745</li>
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
                                <li><a href="#" data-toggle="modal" data-target="#Login-form"><i class="fa fa-user"></i>Login</a></li>
                                <li><a href="{{ route('register') }}"><i class="fa fa-sign-in"></i>Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Link -->

        <!-- Search Form -->
        <div class="main-bar header-right bg-white">
            <div class="container">
                <div class="logo-header">
                    <a href="/">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" width="216" height="37" alt="" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="sticky-header main-bar-wraper">
            <div class="main-bar header-botton nav-bg-secondry">
                <div class="container">
                    <!-- NAV Toggle Button -->
                    <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- ETRA Nav -->

                    <!-- SITE Search -->
                    <div id="search">
                        <span class="close"></span>
                        <form role="search" id="searchform" action="#" method="get" class="radius-xl">
                            <div class="input-group">
                                <input value="" name="q" type="search" placeholder="Type to search"/>
                                <span class="input-group-btn"><button type="button" class="search-btn"><i class="fa fa-search"></i></button></span>
                            </div>
                        </form>
                    </div>

                    <!-- MAIN Vav -->
                    <div class="header-nav navbar-collapse collapse ">
                        <ul class=" nav navbar-nav">
                            <li class="active">
                                <a href="/">Home</a>
                            </li>

                            <li>
                                <a href="{{ route('about_us') }}">About Us</a>

                            </li>

                            <li>
                                <a href="{{ route('contact_us') }}">Contact Us</a>
                            </li>

                            <li>
                                <a href="{{ route('faqs') }}">FAQ</a>

                            </li>

                            <li>
                                <a href="{{ route('services') }}">Services</a>

                            </li>

                            <li>
                                <a href="{{ route('pricing') }}">Plans</a>

                            </li>
                            <li>
                                <a href="{{ route('register') }}">Sign Up</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- HEADER END -->

    <!-- CONTENT START -->
@include('flash::message')
@include('element.flash.error')
@yield('content')
<!-- CONTENT END -->

    <!-- FOOTER START -->
    <footer class="site-footer footer-dark bg-no-repeat bg-full-height bg-center "  style="background-image:url({{ asset('assets/images/background/footer-bg.jpg') }});">
        <!-- FOOTER BLOCKES START -->
        <div class="footer-top overlay-wraper">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="row">
                    <!-- ABOUT COMPANY -->
                    <div class="col-md-3 col-sm-6">
                        <div class="widget widget_about">
                            <h4 class="widget-title text-white">About the Company</h4>
                            <div class="logo-footer clearfix p-b15">
                                <a href="/"><img src="{{ asset('assets/images/logo-light.png') }}" width="230" height="67" alt=""/></a>
                            </div>
                            <p>Expert First (Expexfirst) was Lunched on the 25th of September 2016,
                                As a Financial Institution with the aim of helping investors Globally.
                                Earn profits off Cryptocurrency trading and other investment Options.
                                with a good reputation our Company is recognized across the Globe.
                            </p>
                        </div>
                    </div>
                    <!-- RESENT POST -->
                    <div class="col-md-2 col-sm-4">

                    </div>
                    <!-- USEFUL LINKS -->
                    <div class="col-md-3 col-sm-6">
                        <div class="widget widget_services">
                            <h4 class="widget-title text-white">Useful links</h4>
                            <ul>
                                <li><a href="{{ route('about_us') }}">About</a></li>
                                <li><a href="{{ route('faqs') }}">FAQ</a></li>
                                <li><a href="{{ route('register') }}">Sign Up</a></li>
                                <li><a href="{{ route('services') }}">Services</a></li>
                                <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- NEWSLETTER -->
                    <div class="col-md-3 col-sm-6">
                        <div class="widget widget_newsletter">
                            <h4 class="widget-title text-white">Newsletter</h4>
                            <div class="newsletter-bx">
                                <form role="search" onsubmit=" event.preventDefault(); ">
                                    <div class="input-group">
                                        <input name="news-letter" class="form-control" placeholder="ENTER YOUR EMAIL" type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-paper-plane-o"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- SOCIAL LINKS -->
                        <div class="widget widget_social_inks">
                            <h4 class="widget-title text-white">Social Links</h4>
                            <ul class="social-icons social-square social-darkest">
                                <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3 col-sm-6  p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-primary">
                                <span class="fa fa-map-marker"></span>
                            </div>
                            <div class="icon-content text-white">
                                <h5 class="wt-tilte text-uppercase m-b0">Address</h5>
                                <p>Suite 1840, The Exchange Centre.  935 Gravier Street New Orleans. LA. USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6  p-tb20 ">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix ">
                            <div class="icon-md text-primary">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="icon-content text-white">
                                <h5 class="wt-tilte text-uppercase m-b0">Phone</h5>
                                <p class="m-b0">+1 800-263-9745 </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6  p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-primary">
                                <span class="fa fa-fax"></span>
                            </div>
                            <div class="icon-content text-white">
                                <h5 class="wt-tilte text-uppercase m-b0">Fax</h5>
                                <p class="m-b0">FAX: (---) --------</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                            <div class="icon-md text-primary">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="icon-content text-white">
                                <h5 class="wt-tilte text-uppercase m-b0">Email</h5>
                                <p class="m-b0">support@expexfirst.com</p>
                                <p>info@expexfirst.com</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        <div class="footer-bottom  overlay-wraper">
            <div class="overlay-main"></div>
            <div class="constrot-strip"></div>
            <div class="container p-t30">
                <div class="row">
                    <div class="wt-footer-bot-left">
                        <span class="copyrights-text">© 2016 - 2019  EXPERT FIRST (EXPEX FIRST). All Rights Reserved</span>
                    </div>
                    <div class="wt-footer-bot-right">
                        <ul class="copyrights-nav pull-right">
                            <li><a href="javascript:void(0);">Terms  & Condition</a></li>
                            <li><a href="javascript:void(0);">Privacy Policy</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- BUTTON TOP START -->
    <button class="scroltop"><span class=" iconmoon-house relative" id="btn-vibrate"></span>Top</button>

    <!-- MODAL  LOGIN -->
    @include('element.loginModal')

</div>


<!-- LOADING AREA START ===== -->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-container">
            <div class="cssload-dot bg-primary"><i class="fa fa-bitcoin"></i></div>
        </div>
    </div>
</div>
<!-- LOADING AREA  END ====== -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5d84ce35c22bdd393bb6e3e3/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->

<!-- JAVASCRIPT  FILES ========================================= -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<!-- JQUERY.MIN JS -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- BOOTSTRAP.MIN JS -->

<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<!-- FORM JS -->
<script src="{{ asset('assets/js/jquery.bootstrap-touchspin.min.js') }}"></script>
<!-- FORM JS -->

<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<!-- MAGNIFIC-POPUP JS -->

<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<!-- WAYPOINTS JS -->
<script src="{{ asset('assets/js/counterup.min.js') }}"></script>
<!-- COUNTERUP JS -->
<script src="{{ asset('assets/js/waypoints-sticky.min.js') }}"></script>
<!-- COUNTERUP JS -->

<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<!-- MASONRY  -->

<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!-- OWL  SLIDER  -->

<script src="{{ asset('assets/js/stellar.min.js') }}"></script>
<!-- PARALLAX BG IMAGE   -->
<script src="{{ asset('assets/js/scrolla.min.js') }}"></script>
<!-- ON SCROLL CONTENT ANIMTE   -->

<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('assets/js/shortcode.js') }}"></script>
<!-- SHORTCODE FUCTIONS  -->
<script src="{{ asset('assets/js/switcher.js') }}"></script>
<!-- SWITCHER FUCTIONS  -->
<script src="{{ asset('assets/js/jquery.bgscroll.js') }}"></script>
<!-- BACKGROUND SCROLL -->
<script src="{{ asset('assets/js/tickerNews.min.js') }}"></script>
<!-- TICKERNEWS-->
<!-- TICKERNEWS FUNCTiON -->
<script type="text/javascript">
    jQuery(function () {
        var timer = !1;
        _Ticker = jQuery("#T1").newsTicker();
        _Ticker.on("mouseenter", function () {
            var __self = this;
            timer = setTimeout(function () {
                __self.pauseTicker();
            }, 200);
        });
        _Ticker.on("mouseleave", function () {
            clearTimeout(timer);
            if (!timer) return !1;
            this.startTicker();
        });
    });
</script>
<!-- REVOLUTION JS FILES -->

<script src="{{ asset('assets/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{ asset('assets/plugins/revolution/revolution/js/extensions/revolution-plugin.js') }}"></script>

<!-- REVOLUTION SLIDER FUNCTION  ===== -->
<script src="{{ asset('assets/js/rev-script-1.js') }}"></script>


<!-- STYLE SWITCHER  ======= -->

<!-- STYLE SWITCHER END ==== -->


</body>
</html>
