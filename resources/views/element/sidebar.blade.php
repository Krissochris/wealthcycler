<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/">
                <h2> TYEN CLUB</h2>
{{--
                <img src="{{ asset('account/images/logo.png') }}" alt="Logo">
--}}
                </a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @can('admin_dashboard')
{{--
                <h3 class="menu-title"> Administration </h3><!-- /.menu-title -->
--}}
                @endcan

                @can('admin_dashboard')
                <li>
                    <a href="{{ route('admin_dashboard:index') }}"> <i class="menu-icon fa fa-laptop"></i>Admin Dashboard </a>
                </li>
                @endcan
                @can('users_management')
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i> User Management </a>
                        <ul class="sub-menu children dropdown-menu">
                            @can('users')
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('users:index') }}"> Users </a></li>
                            @endcan
                            @can('roles')
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('roles:index') }}">{{ __('Roles') }}</a></li>
                            @endcan
                            @can('directors')
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('directors:index') }}">{{ __('Directors') }}</a></li>
                            @endcan

                            @can('coordinators')
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('coordinators:index') }}">{{ __('State Coordinators') }}</a></li>
                            @endcan

                            @can('leaders')
                            <li><i class="fa fa-id-badge"></i><a href="{{ route('leaders:index') }}">{{ __('Leaders') }}</a></li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                @can('virtual_platform')
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i> Virtual Platform </a>
                    <ul class="sub-menu children dropdown-menu">
                        @can('packages')
                        <li><i class="fa fa-bars"></i><a href="{{ route('packages:index') }}"> {{ __('Packages') }}</a></li>
                        @endcan

                        @can('provide_funds')
                        <li><i class="fa fa-share-square-o"></i><a href="{{ route('provide_donations:index') }}"> {{ __('Provide Funds') }} </a></li>
                        @endcan

                        @can('get_funds')
                        <li><i class="fa fa-id-card-o"></i><a href="{{ route('get_donations:index') }}"> {{ __('Get Fund') }}</a></li>
                        @endcan

                        @can('virtual_merges')
                        <li><i class="fa fa-exclamation-triangle"></i><a href="{{ route('virtual_merges:index') }}"> {{ __('Virtual Merges') }} </a></li>
                        @endcan

                    </ul>
                </li>
                @endcan

                @can('settings')
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i> Settings </a>
                    <ul class="sub-menu children dropdown-menu">

                            <li><a href="{{ route('site_settings:edit') }}"> Site Settings </a></li>
                            <li><a href="{{ route('pages:index') }}"> Pages </a></li>
                        <li><a href="{{ route('faqs:index') }}"> Faqs </a></li>

                    @can('countries')
                        <li><a href="{{ route('countries:index') }}"> Countries </a></li>
                        @endcan

                        @can('states')
                        <li><a href="{{ route('states:index') }}">{{ __('States') }}</a></li>
                        @endcan

                        @can('currencies')
                        <li><a href="{{ route('currencies:index') }}"> {{ __('Currencies') }}</a></li>
                        @endcan

                        @can('currency_exchanges')
                        <li><a href="{{ route('currency_exchange_rates:index') }}"> {{ __('Currency Exchange Rate') }} </a></li>
                        @endcan

                        @can('banks')
                        <li><a href="{{ route('banks:index') }}"> {{ __('Banks') }} </a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                    @can('virtual_platform')
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-google-wallet"></i> Dividend Wallets </a>
                            <ul class="sub-menu children dropdown-menu">
                                <li class="">
                                    <a href="{{ route('dividend_wallets:index') }}">
                                        All Wallets
                                    </a>
                                </li>
                                    <li class="">
                                        <a href="{{ route('dividend_wallets:show_credit_wallet') }}">
                                            Credit Dividend Wallet
                                        </a>
                                    </li>
                            </ul>
                        </li>
                    @endcan


                @can('withdrawals')
                <li class="">
                    <a href="{{ route('withdrawals:index') }}"> <i class="menu-icon fa fa-laptop"></i>User Withdrawals </a>
                </li>
                @endcan

                @can('testimonies')
                <li class="">
                    <a href="{{ route('testimonies:index') }}"> <i class="menu-icon fa fa-laptop"></i>Testimonies </a>
                </li>
                @endcan

                @can('teams')
                <li class="dropdown">
                    <a href="{{ route('teams:index') }}"> <i class="menu-icon fa fa-users"></i>Teams </a>
                </li>
                @endcan

                @can('maintenance_fees')
                <li class="dropdown">
                    <a href="{{ route('maintenance_fees:index') }}"> <i class="menu-icon fa fa-users"></i>Maintenance Fees </a>
                </li>
                @endcan


                <h3 class="menu-title"> My Links </h3><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('home') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li class="">
                    <a href="{{ route('user_notifications:index') }}"> <i class="menu-icon fa fa-bell"></i> Notifications </a>
                </li>
                <li class="">
                    <a href="{{ route('user_packages:index') }}"> <i class="menu-icon fa fa-tasks"></i> My VFS </a>
                </li>
                <li>
                    <a href="{{ route('transfer:index') }}"> <i class="menu-icon ti-email"></i> Transfer </a>
                </li>
                <li>
                    <a href="{{ route('make_deposit:index') }}"> <i class="menu-icon ti-email"></i> Make Deposit </a>
                </li>
                <li>
                    <a href="{{ route('user_referrals:index') }}"> <i class="menu-icon ti-email"></i> My Referrals </a>
                </li>
                <li>
                    <a href="{{ route('user_withdrawals:index') }}"> <i class="menu-icon ti-email"></i>Withdrawals </a>
                </li>
                <li>
                    <a href="{{ route('user_testimonies:index') }}"> <i class="menu-icon ti-email"></i> Testimonies </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->
