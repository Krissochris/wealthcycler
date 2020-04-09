@extends("layouts.frontend")

@section("content")
    <header>
        <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" id="page-top" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url({{ asset('frontend/images/cover (1).jpg') }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>First Slide</h2>
                        <p>This is a description for the first slide.</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url({{ asset('frontend/images/cover (2).jpg') }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Second Slide</h2>
                        <p>This is a description for the second slide.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url({{ asset('frontend/images/cover.jpeg') }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Third Slide</h2>
                        <p>This is a description for the third slide.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="bg-dark">
            <div class="container">
                <div class="row">
                    <div class="text-center col-lg-6 col-sm-12 py-3 font-weight-bold" style="border-color: transparent; color: white">
                        {{ number_format($totalUsers) }} Active Club Members
                    </div>
                    <div class="text-center col-lg-6 col-sm-12 py-3 font-weight-bold" style="border-color: transparent; color: white"> Life Time Access</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <h1 class="my-4 text-center"> WHAT WE DO </h1>

        <!-- Table / Card Section -->
        <div class="row">
            <div class="col-lg-3 mb-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5> SOCIAL ENGAGEMENTS</h5>
                        <p class="card-text">
                            (Sports, Pageantry, Inter-engagement Competitions)
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>ONLINE DONATIONS</h5>
                        <p class="card-text">
                            (Compounding Savings)
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>YOUTH EMPOWERMENT</h5>
                        <p class="card-text">
                           (Idea funding)
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5> CLUB GROUP - MEMBER TO MEMBER SUPPORT</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Youtube Section -->
        <div class="py-3"></div>
        <h2 class="text-center mb-4"> About Us</h2>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <p>
                    We are the 'YOU and I'. We are the Youths all around the world. We are TYEN
                (The Young Entreprenuers Network). We are the leaders of our time. if you are opportune to be reading this, then you are one of us.</p>

                <p class="mt-4">
                    MOTTO: <br>
                    <strong>TYEN - modelling future entreprenuers</strong>
                </p>
            </div>


            <div class="col-lg-6 col-sm-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/LToLyCg0zeI?rel=0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Mission Statement -->
        <div class="py-3"></div>
        <h2 class="text-center mb-4"> MISSION STATEMENT</h2>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-justify">
                <p>
                Our mission is to create a community where age is not a determinant for true wealth creation. Build a system where money wouldn't be seen
                    as a limitation to idea creation and business development. Ensure peace and unity among every nation of the world by bring everyone together as
                    a community through our club and sharing same selfless ideology upon which the club was built with each and everyone of us!.
                </p>

            </div>

        </div>

        <!-- Mission Statement -->
        <div class="py-3"></div>
        <h2 class="text-center mb-4"> VISION STATEMENT</h2>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-justify">
                <p>
                Our vision is to build a community of young and highly enterprising youths with a membership base of over one million people in less than
                    3years in each country around the world.
                </p>
                <p>
                    We are modelling future entreprenuers.
                </p>

            </div>

        </div>



        <div class="py-3"></div>
        <h2 class="text-center"> Our Team </h2>
        <div class="row">
            @if (isset($teams) && !empty($teams))
                @foreach($teams as $team)
                    <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img class="img-fluid" style="max-height: 150px; width: 100%" src="{{ $team->photo }}" alt="{{ $team->name }}">
                            <div class="card-body">
                                <h6 class="card-title text-center">
                                    {{ $team->name }} <br>
                                    <i> {{ $team->position }} </i>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="py-3"></div>
        <h2 class="text-center"> Our Latest Members </h2>

        <div class="row text-center">
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
            </div>
            <div class="text-center">
                <a href="{{ route('members:index') }}"> View all members </a>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-md-8 col-center m-auto">
                <h2 class="text-center mb-4"> WHAT OUR MEMBERS SAY ABOUT US </h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                   {{-- <!-- Carousel indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>--}}
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">
                        @for($num = 0; $num < count($testimonies); $num++)
                            <div class="item carousel-item @if($num == 0) active  @endif " style="height: 200px">
                                <p class="testimonial">
                                    {{ $testimonies[$num]['testimony'] }}
                                </p>
                                <p class="overview"><b> {{ $testimonies[$num]['user']['name'] }}</b> </p>
                            </div>
                        @endfor

                        {{--<div class="item carousel-item">
                            <p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio.</p>
                            <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
                        </div>
                        <div class="item carousel-item">
                            <p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit dolor eget rutrum.</p>
                            <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
                        </div>--}}
                    </div>
                    {{--<!-- Carousel controls -->
                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>--}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
@endsection
