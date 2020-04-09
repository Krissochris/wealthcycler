<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> {{ config('app.name', '') }} >> @yield("title") </title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset("frontend/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/vendor/simple-line-icons/css/simple-line-icons.css") }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{ asset("frontend/css/custom.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("frontend/vendor/fontawesome-free/css/fontawesome.min.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name') }} </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="nav navbar-nav">
                <li class="nav-item"> <a href="" class="nav-link text-white-90">Privacy Policy</a></li>
                <li class="nav-item"> <a href="" class="nav-link text-white-90">Terms and Conditions</a></li>
                <li class="nav-item"> <a href="" class="nav-link text-white-90">Disclaimer</a></li>
                <li class="nav-item"> <a href="" class="nav-link text-white-90">SCUML Disclosure & Agreement</a></li>
                <li class="nav-item"> <a href="" class="nav-link text-white-90">Refund Policy</a></li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link btn btn-outline" style="border-color: white; color: white" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary" style="color: white; font-weight: bold" href="{{ route('register') }}">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="mt-4 mb-4">
    @yield("content")
</div>

<!-- Footer -->
<div class="fixed-bottom" >
    <a href="#page-top"><i class="fa fa-angle-double-up fa-3x fa-fw text-primary" style="float: right;"></i></a>
</div>
<footer class="footer bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                {{--<ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="#">About</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#" style="color: blue; font-weight: bold;">Contact</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="term.html" style="color: blue; font-weight: bold;">Terms of Use</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#" style="color: blue; font-weight: bold;">Privacy Policy</a>
                    </li>
                </ul>--}}
                <p class="text-white mb-4">
                    Copyright &copy; <strong> {{ config('site_settings.name') }} </strong> - All Right Reserved.
                </p>

                <p class="text-white">Proudly Powered by: <strong> {{ config('site_settings.powered_by') }} </strong>
                </p>
            </div>
            <div class="col-lg-6 text-center text-lg-right my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fab fa-facebook text-primary"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fab fa-twitter-square text-primary"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-linkedin fa-fw text-primary"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-telegram fa-fw text-primary"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-instagram fa-fw text-primary"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset("frontend/vendor/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("frontend/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2();
    });
</script>
</body>
</html>
