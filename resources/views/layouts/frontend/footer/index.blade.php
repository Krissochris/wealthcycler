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
                        <h4 class="widget-title text-white">About {{ setting('app_name') }} </h4>
                        <div class="logo-footer clearfix p-b15">
                            <a href="/"><img src="{{ asset('assets/images/logo-white-xs.png') }}" width="230" height="67" alt=""/></a>
                        </div>
                        {!! setting('app_about_us') !!}
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
                            <li><a href="{{ route('pages:view', 'page_about_us') }}">About Us</a></li>
                            <li><a href="/faqs">FAQ</a></li>
                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                            <li><a href="{{ route('pages:view', 'page_contact_us') }}">Contact Us</a></li>
                            <li><a href="{{ route('pages:view', 'page_scuml_disclosure_&_agreement') }}">SCUML Disclosure & Agreement</a></li>
                            <li><a href="{{ route('pages:view', 'page_refund_policy') }}">Refund Policy </a></li>
                            <li><a href="{{ route('pages:view', 'page_disclaimer') }}">Disclaimer </a></li>
                            <li><a href="{{ route('pages:view', 'page_terms_&_conditions') }}">Terms  & Condition</a></li>
                            <li><a href="{{ route('pages:view', 'page_privacy_policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('pages:view', 'page_become_an_affiliate') }}">Become An Affiliate</a></li>
                            <li><a href="{{ route('pages:view', 'page_values_to_expect') }}">Values To Expect</a></li>
                        </ul>
                    </div>
                </div>
                <!-- NEWSLETTER -->
                <div class="col-md-3 col-sm-6">
                    <!-- SOCIAL LINKS -->
                    <div class="widget widget_social_inks">
                        <h4 class="widget-title text-white">Social Links</h4>
                        <ul class="social-icons social-square social-darkest">
                            <li><a href="{{ setting('app_facebook_url')  }}" target="_blank" class="fa fa-facebook"></a></li>
                            <li><a href="{{ setting('app_twitter_url') }}" target="_blank" class="fa fa-twitter"></a></li>
                            <li><a href="{{ setting('app_linkedIn_url') }}" target="_blank" class="fa fa-linkedin"></a></li>
                            <li><a href="{{ setting('app_youtube_url')}}" target="_blank" class="fa fa-youtube"></a></li>
                            <li><a href="{{ setting('app_instagram_url') }}" target="_blank" class="fa fa-instagram"></a></li>
                            <li><a href="{{ setting('app_telegram_url') }}" target="_blank" class="fa fa-telegram"></a></li>
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
                            <p> {{ setting('app_address') }} </p>
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
                            <p class="m-b0"> {{ setting('app_company_mobile_1') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_2') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_3') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_4') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_5') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_6') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_7') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_8') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_9') }} </p>
                            <p class="m-b0"> {{ setting('app_company_mobile_10') }} </p>
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
                            <p class="m-b0">{{ setting('app_company_email_1') }}</p>
                            <p> {{ setting('app_company_email_2') }}</p>
                            <p> {{ setting('app_company_email_3') }}</p>
                            <p> {{ setting('app_company_email_4') }}</p>
                            <p> {{ setting('app_company_email_5') }}</p>
                            <p> {{ setting('app_company_email_6') }}</p>
                            <p> {{ setting('app_company_email_7') }}</p>
                            <p> {{ setting('app_company_email_8') }}</p>
                            <p> {{ setting('app_company_email_9') }}</p>
                            <p> {{ setting('app_company_email_10') }}</p>
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
                    <p class="copyrights-text">
                        Copyright &copy; <strong> {{ config('site_settings.name') }} </strong> - All Right Reserved.
                    </p>

                    <p class="text-white">Proudly Powered by: <strong> {{ config('site_settings.powered_by') }} </strong>
                    </p>
                </div>
                <div class="wt-footer-bot-right">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="{{ route('pages:view', 'page_terms_&_conditions') }}">Terms  & Condition</a></li>
                        <li><a href="{{ route('pages:view', 'page_refund_policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('pages:view', 'page_disclaimer') }}">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->


<!-- BUTTON TOP START -->
<button class="scroltop"> <i class="fa fa-arrow-up"></i> Top</button>

<!-- MODAL  LOGIN -->
{{--
@include('element.loginModal')
--}}

<!-- LOADING AREA START ===== -->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-container">
            <div class="cssload-dot" style="background-color: white;"><img src="{{ asset('assets/images/logo.png') }}" alt=""> </div>
        </div>
    </div>
</div>
<!-- LOADING AREA  END ====== -->
<!--Start of Tawk.to Script-->
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

<!-- REVOLUTION JS FILES -->

<script src="{{ asset('assets/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{ asset('assets/plugins/revolution/revolution/js/extensions/revolution-plugin.js') }}"></script>

<!-- REVOLUTION SLIDER FUNCTION  ===== -->
<script src="{{ asset('assets/js/rev-script-1.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2();
    });
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5e317bee8e78b86ed8aba1e8/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
