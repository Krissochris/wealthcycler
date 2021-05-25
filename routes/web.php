<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $teams = App\Team::all();
    $totalUsers = App\User::where('is_pro_member', 1)->count();
    $latestMembers = \App\User::query()->latest()->limit(5)->get(['name', 'created_at']);
    $testimonies = \App\Testimony::query()
        ->with(['user:id,name'])
        ->where('status', 1)
        ->latest()->limit(5)->get();
    return view('pages.index', compact('teams', 'totalUsers', 'latestMembers', 'testimonies'));
});

Route::get('/faqs', function () {
    $faqs = App\Faq::query()->orderBy('order')
    ->where('status', 1)->get();
    return view('pages.faqs.index', compact('faqs'));
});

Auth::routes(['verify' => true]);

Route::get('/members/index', 'MembersController@index')->name('members:index');
Route::get('/pages/view/{page}', 'PagesController@view')->name('pages:view');


Route::middleware(['auth'])->group(function() {

    Route::post('/update_email_address', 'UpdateEmailAddressController@update')->name('update_email_address');

    Route::middleware(['verified'])->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/become_pro_member', 'BecomeProMemberController@index')->name('become_pro_member');
        Route::post('/become_pro_member/step_2', 'BecomeProMemberController@process_payment')->name('become_pro_member:step_2');
        Route::post('/become_pro_member/verify_coupon_code', 'BecomeProMemberController@verifyCouponCode')->name('become_pro_member:verify_coupon_code');

        Route::get('/payment_processor/paypal', 'PayPalPaymentController@index')->name('payment_processor:paypal');
        Route::get('/payment_processor/paypal/status', 'PayPalPaymentController@getPaymentStatus')->name('payment_processor:paypal:status');

        Route::get('/payment_processor/coinpayment', 'CoinPaymentController@index')->name('payment_processor:coin_payment');
        Route::get('/payment_processor/coinpayment/makeDeposit/{transaction}', 'CoinPaymentController@makeDeposit')->name('payment_processor:coin_payment:make_deposit');
        Route::get('/payment_processor/coinpayment/confirmDeposit', 'CoinPaymentController@confirmDeposit')->name('payment_processor:coin_payment:confirm_deposit');

        Route::get('/payment_processor/rave_payment', 'RavePaymentController@process')->name('payment_processor:rave_payment');
        Route::post('/payment_processor/rave_payment/status', 'RavePaymentController@getPaymentStatus')->name('payment_processor:rave_payment:status');

        Route::get('/payment_processor/bank_transfer', 'BankTransferController@process')->name('payment_processor:bank_transfer');



        Route::middleware(['upgrade_account'])->group(function() {
            Route::get('/home', 'HomeController@index')->name('home');

            Route::get('/user_packages', 'UserPackagesController@index')->name('user_packages:index');
            Route::post('/user_packages/join_package/{package_id}', 'UserPackagesController@joinPackage')->name('user_packages:join_package');
            Route::get('/user_packages/upgrade/payment', 'UserPackagesController@payment')->name('user_packages:payment');
            Route::post('/user_packages/upgrade/payment', 'UserPackagesController@processPayment')->name('user_packages:payment');

            Route::get('/profile/edit', 'ProfileController@edit')->name('profile:edit');
            Route::post('/profile/edit', 'ProfileController@update')->name('profile:edit');
            Route::post('/payment_details/edit', 'PaymentDetailsController@update')->name('payment_details:edit');


            Route::get('/make_deposit', 'MakeDepositController@index')->name('make_deposit:index');
            Route::post('/make_deposit/process', 'MakeDepositController@processDeposit')->name('make_deposit:process');

            /**
             * User Notifications
             */
            Route::get('/user_notifications', 'UserNotificationController@index')->name('user_notifications:index');


            /**
             * Make a transfer
             */

            Route::get('/transfer', 'TransferController@index')->name('transfer:index');
            Route::post('/transfer', 'TransferController@process')->name('transfer:process');


            Route::get('/user_withdrawals', 'UserWithdrawalsController@index')->name('user_withdrawals:index');
            Route::get('/user_withdrawals/create', 'UserWithdrawalsController@create')->name('user_withdrawals:create');
            Route::post('/user_withdrawals/create', 'UserWithdrawalsController@store')->name('user_withdrawals:store');


            Route::get('/user_testimonies', 'UserTestimonyController@index')->name('user_testimonies:index');
            Route::get('/user_testimonies/create', 'UserTestimonyController@create')->name('user_testimonies:create');
            Route::post('/user_testimonies/create', 'UserTestimonyController@store')->name('user_testimonies:store');
            Route::get('/user_testimonies/edit/{testimony}', 'TestimoniesController@edit')->name('testimonies:edit');
            Route::post('/user_testimonies/edit/{testimony}', 'TestimoniesController@update')->name('testimonies:update');
            Route::delete('/user_testimonies/delete/{testimony}', 'TestimoniessController@destroy')->name('testimonies:delete');


            Route::get('/user_virtual_withdrawals', 'UserVirtualWithdrawalsController@index')->name('user_virtual_withdrawals:index');
            Route::get('/user_virtual_withdrawals/create', 'UserVirtualWithdrawalsController@create')->name('user_virtual_withdrawals:create');
            Route::post('/user_virtual_withdrawals/create', 'UserVirtualWithdrawalsController@store')->name('user_virtual_withdrawals:store');

            // referrals
            Route::get('/referrals', 'UserReferralsController@index')->name('user_referrals:index');

        });
    });
});



Route::middleware(['auth'/*,'role:admin'*/])->group(function() {
    /** Admin Controllers */

    Route::get('/site_settings', 'SettingsController@edit')->name('site_settings:edit');
    Route::post('/site_settings', 'SettingsController@update')->name('site_settings:edit');


    Route::get('/admin_dashboard', 'DashboardController@index')->name('admin_dashboard:index');

    /** Maintenance Fee */
    Route::get('/maintenance_fees', 'MaintenanceFeesController@index')->name('maintenance_fees:index');


    Route::get('/packages', 'PackagesController@index')->name('packages:index');
    Route::get('/packages/create', 'PackagesController@create')->name('packages:create');
    Route::post('/packages/create', 'PackagesController@store')->name('packages:store');
    Route::get('/packages/edit/{package}', 'PackagesController@edit')->name('packages:edit');
    Route::put('/packages/edit/{package}', 'PackagesController@update')->name('packages:update');
    Route::get('/packages/view/{package}', 'PackagesController@show')->name('packages:view');
    Route::delete('/packages/delete/{package}', 'PackagesController@destroy')->name('packages:delete');

    Route::post('/users/update_permissions/{user}', 'UsersController@updatePermissions')->name('users:update_permissions');
    Route::get('/users', 'UsersController@index')->name('users:index');
    Route::get('/users/create', 'UsersController@create')->name('users:create');
    Route::post('/users/create', 'UsersController@store')->name('users:store');
    Route::get('/users/edit/{user}', 'UsersController@edit')->name('users:edit');
    Route::put('/users/edit/{user}', 'UsersController@update')->name('users:update');
    Route::post('/users/payment-detail/{userPaymentDetail}', 'UsersController@updatePaymentDetail')->name('users:update_payment_detail');

    Route::get('/users/view/{user}', 'UsersController@show')->name('users:view');
    Route::delete('/users/delete/{user}', 'UsersController@destroy')->name('users:delete');


    Route::get('/roles', 'RolesController@index')->name('roles:index');
    Route::get('/roles/create', 'RolesController@create')->name('roles:create');
    Route::post('/roles/create', 'RolesController@store')->name('roles:store');
    Route::get('/roles/edit/{role}', 'RolesController@edit')->name('roles:edit');
    Route::put('/roles/edit/{role}', 'RolesController@update')->name('roles:update');
    Route::get('/roles/view/{role}', 'RolesController@show')->name('roles:view');
    Route::delete('/roles/delete/{role}', 'RolesController@destroy')->name('roles:delete');

    Route::get('/provide_donations', 'ProvideDonationsController@index')->name('provide_donations:index');
    Route::get('/provide_donations/create', 'ProvideDonationsController@create')->name('provide_donations:create');
    Route::post('/provide_donations/create', 'ProvideDonationsController@store')->name('provide_donations:store');
    Route::get('/provide_donations/edit/{provideDonation}', 'ProvideDonationsController@edit')->name('provide_donations:edit');
    Route::put('/provide_donations/edit/{provideDonation}', 'ProvideDonationsController@update')->name('provide_donations:update');
    Route::delete('/provide_donations/delete/{provideDonation}', 'ProvideDonationsController@destroy')->name('provide_donations:delete');

    Route::get('/get_donations', 'GetDonationsController@index')->name('get_donations:index');
    Route::get('/get_donations/create', 'GetDonationsController@create')->name('get_donations:create');
    Route::post('/get_donations/create', 'GetDonationsController@store')->name('get_donations:store');
    Route::get('/get_donations/edit/{getDonation}', 'GetDonationsController@edit')->name('get_donations:edit');
    Route::put('/get_donations/edit/{getDonation}', 'GetDonationsController@update')->name('get_donations:update');
    Route::delete('/get_donations/delete/{getDonation}', 'GetDonationsController@destroy')->name('get_donations:delete');


    Route::get('/virtual_merges', 'VirtualMergesController@index')->name('virtual_merges:index');
    Route::get('/virtual_merges/create', 'VirtualMergesController@create')->name('virtual_merges:create');
    Route::post('/virtual_merges/create', 'VirtualMergesController@store')->name('virtual_merges:store');
    Route::get('/virtual_merges/edit/{virtualMerge}', 'VirtualMergesController@edit')->name('virtual_merges:edit');
    Route::put('/virtual_merges/edit/{virtualMerge}', 'VirtualMergesController@update')->name('virtual_merges:update');
    Route::delete('/virtual_merges/delete/{virtualMerge}', 'VirtualMergesController@destroy')->name('virtual_merges:delete');

    /** Countries */
    Route::get('/countries', 'CountriesController@index')->name('countries:index');
    Route::get('/countries/create', 'CountriesController@create')->name('countries:create');
    Route::post('/countries/create', 'CountriesController@store')->name('countries:store');
    Route::get('/countries/edit/{country}', 'CountriesController@edit')->name('countries:edit');
    Route::put('/countries/edit/{country}', 'CountriesController@update')->name('countries:update');
    Route::delete('/countries/delete/{country}', 'CountriesController@destroy')->name('countries:delete');

    /** States */
    Route::get('/states', 'StatesController@index')->name('states:index');
    Route::get('/states/create', 'StatesController@create')->name('states:create');
    Route::post('/states/create', 'StatesController@store')->name('states:store');
    Route::get('/states/edit/{state}', 'StatesController@edit')->name('states:edit');
    Route::put('/states/edit/{state}', 'StatesController@update')->name('states:update');
    Route::delete('/states/delete/{state}', 'StatesController@destroy')->name('states:delete');

    /** Currencies */
    Route::get('/currencies', 'CurrenciesController@index')->name('currencies:index');
    Route::get('/currencies/create', 'CurrenciesController@create')->name('currencies:create');
    Route::post('/currencies/create', 'CurrenciesController@store')->name('currencies:store');
    Route::get('/currencies/edit/{currency}', 'CurrenciesController@edit')->name('currencies:edit');
    Route::put('/currencies/edit/{currency}', 'CurrenciesController@update')->name('currencies:update');
    Route::delete('/currencies/delete/{currency}', 'CurrenciesController@destroy')->name('currencies:delete');

    /** Currency Exchange Rate */
    Route::get('/currency_exchange_rates', 'CurrencyExchangeRatesController@index')->name('currency_exchange_rates:index');
    Route::get('/currency_exchange_rates/create', 'CurrencyExchangeRatesController@create')->name('currency_exchange_rates:create');
    Route::post('/currency_exchange_rates/create', 'CurrencyExchangeRatesController@store')->name('currency_exchange_rates:store');
    Route::get('/currency_exchange_rates/edit/{currencyExchangeRate}', 'CurrencyExchangeRatesController@edit')->name('currency_exchange_rates:edit');
    Route::put('/currency_exchange_rates/edit/{currencyExchangeRate}', 'CurrencyExchangeRatesController@update')->name('currency_exchange_rates:update');
    Route::delete('/currency_exchange_rates/delete/{currencyExchangeRate}', 'CurrencyExchangeRatesController@destroy')->name('currency_exchange_rates:delete');


    /** Leaders */
    Route::get('/leaders', 'LeadersController@index')->name('leaders:index');
    Route::get('/leaders/create', 'LeadersController@create')->name('leaders:create');
    Route::post('/leaders/create', 'LeadersController@store')->name('leaders:store');
    Route::get('/leaders/edit/{leader}', 'LeadersController@edit')->name('leaders:edit');
    Route::put('/leaders/edit/{leader}', 'LeadersController@update')->name('leaders:update');
    Route::delete('/leaders/delete/{leader}', 'LeadersController@destroy')->name('leaders:delete');



    /** State coordinators */
    Route::get('/coordinators', 'CoordinatorsController@index')->name('coordinators:index');
    Route::get('/coordinators/create', 'CoordinatorsController@create')->name('coordinators:create');
    Route::post('/coordinators/create', 'CoordinatorsController@store')->name('coordinators:store');
    Route::get('/coordinators/edit/{coordinator}', 'CoordinatorsController@edit')->name('coordinators:edit');
    Route::put('/coordinators/edit/{coordinator}', 'CoordinatorsController@update')->name('coordinators:update');
    Route::get('/coordinators/view/{id}', 'CoordinatorsController@show')->name('coordinators:view');
    Route::delete('/coordinators/delete/{coordinator}', 'CoordinatorsController@destroy')->name('coordinators:delete');

    /** Directors */
    Route::get('/directors', 'DirectorsController@index')->name('directors:index');
    Route::get('/directors/create', 'DirectorsController@create')->name('directors:create');
    Route::post('/directors/create', 'DirectorsController@store')->name('directors:store');
    Route::get('/directors/edit/{director}', 'DirectorsController@edit')->name('directors:edit');
    Route::put('/directors/edit/{director}', 'DirectorsController@update')->name('directors:update');
    Route::delete('/directors/edit/{director}', 'DirectorsController@destroy')->name('directors:delete');


    /** Testimonies */
    Route::get('/testimonies', 'TestimoniesController@index')->name('testimonies:index');
    Route::get('/testimonies/create', 'TestimoniesController@create')->name('testimonies:create');
    Route::post('/testimonies/create', 'TestimoniesController@store')->name('testimonies:store');
    Route::get('/testimonies/edit/{testimony}', 'TestimoniesController@edit')->name('testimonies:edit');
    Route::post('/testimonies/edit/{testimony}', 'TestimoniesController@update')->name('testimonies:update');
    Route::delete('/testimonies/delete/{testimony}', 'TestimoniessController@destroy')->name('testimonies:delete');

    /**
     * Teams
     */
    Route::get('/teams', 'TeamsController@index')->name('teams:index');
    Route::get('/teams/create', 'TeamsController@create')->name('teams:create');
    Route::post('/teams/create', 'TeamsController@store')->name('teams:create');
    Route::get('/teams/edit/{team}', 'TeamsController@edit')->name('teams:edit');
    Route::post('/teams/edit/{team}', 'TeamsController@update')->name('teams:edit');
    Route::delete('/teams/delete/{team}', 'TeamsController@destroy')->name('teams:delete');

    /**
     * Banks
     */
    Route::get('/banks', 'BanksController@index')->name('banks:index');
    Route::get('/banks/create', 'BanksController@create')->name('banks:create');
    Route::post('/banks/create', 'BanksController@store')->name('banks:create');
    Route::get('/banks/edit/{bank}', 'BanksController@edit')->name('banks:edit');
    Route::post('/banks/edit/{bank}', 'BanksController@update')->name('banks:edit');
    Route::delete('/banks/delete/{bank}', 'BanksController@destroy')->name('banks:delete');

    /** Settings Pages */
    Route::get('/pages', 'PagesController@index')->name('pages:index');
    Route::get('/pages/edit/{page}', 'PagesController@edit')->name('pages:edit');
    Route::post('/pages/edit/{page}', 'PagesController@update')->name('pages:edit');

    /**
     * FAQs
     */
    Route::get('/faqs/index', 'FaqsController@index')->name('faqs:index');
    Route::get('/faqs/create', 'FaqsController@create')->name('faqs:create');
    Route::post('/faqs/create', 'FaqsController@store')->name('faqs:create');
    Route::get('/faqs/edit/{faq}', 'FaqsController@edit')->name('faqs:edit');
    Route::post('/faqs/edit/{faq}', 'FaqsController@update')->name('faqs:edit');
    Route::delete('/faqs/delete/{faq}', 'FaqsController@destroy')->name('faqs:delete');




    Route::post('/users/subscribeToPackage', 'UsersController@subscribeToPackage')->name('users:subscribeToPackage');



    /** Withdrawals  */
    Route::get('/withdrawals', function() {
        return view('withdrawals.index');
    })->name('withdrawals:index');


    /**
     * Withdrawals
     */
    Route::get('/withdrawals', 'WithdrawalsController@index')->name('withdrawals:index');
    Route::get('/withdrawals/edit/{withdrawal}', 'WithdrawalsController@edit')->name('withdrawals:edit');
    Route::post('/withdrawals/edit/{withdrawal}', 'WithdrawalsController@update')->name('withdrawals:edit');
    Route::get('/withdrawals/view/{withdrawal}', 'WithdrawalsController@show')->name('withdrawals:view');
    Route::post('/withdrawals/paid/{withdrawal}', 'WithdrawalsController@paid')->name('withdrawals:paid');


    Route::get('/dividend-wallets/index', 'DividendWalletsController@index')
        ->name('dividend_wallets:index');
    Route::get('/dividend-wallets/credit', 'DividendWalletsController@showCreditWalletView')
        ->name('dividend_wallets:show_credit_wallet');
    Route::post('/dividend-wallets/credit', 'DividendWalletsController@creditWallet')
        ->name('dividend_wallets:credit_wallet');
    Route::get('/dividend-wallets/edit/{dividendWallet}', 'DividendWalletsController@edit')
        ->name('dividend_wallets:edit');
    Route::post('/dividend-wallets/edit/{dividendWallet}', 'DividendWalletsController@update')
        ->name('dividend_wallets:update');
    Route::post('/dividend-wallets/create', 'DividendWalletsController@store')
        ->name('dividend_wallets:store');
    Route::post('/dividend-wallets/add-transaction/{dividendWallet}', 'DividendWalletsController@addTransaction')
        ->name('dividend_wallets:add_transaction');

    // dividend wallet transactions
    Route::get('/dividend-wallet-transactions/index', 'DividendWalletTransactionsController@index')
        ->name('dividend_wallet_transactions:index');



    Route::get('/savings_wallet/{user_id}', 'SavingsWalletController@edit')->name('savings_wallet:edit');
    Route::post('/savings_wallet/{user_id}', 'SavingsWalletController@update')->name('savings_wallet:edit');
    Route::post('/virtual_wallet/{user_id}', 'VirtualWalletController@update')->name('virtual_wallet:edit');

    Route::get('/user-wallets/{user_id}', 'UserWalletsController@wallets')->name('user_wallets:index');

});

