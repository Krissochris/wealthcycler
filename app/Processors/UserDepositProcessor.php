<?php

namespace App\Processors;

use App\Package;
use App\Repositories\PackageRepository;
use App\User;

class UserDepositProcessor {

    CONST PRO_MEMBER_DEPOSIT = '1001';
    CONST NORMAL_DEPOSIT = '1002';
    CONST PACKAGE_UPGRADE_DEPOSIT = '1003';

    public function __construct($deposit)
    {
        // check type of user deposit
        // credit the wallet
        // perform other necessary actions
        if ($deposit['item_no'] === static::PRO_MEMBER_DEPOSIT) {
            $user = User::query()
                ->with(['virtual_wallet'])
                ->where('id', $deposit['user_id'])
                ->first();

            $user->makeProMember('payment');
            $user->virtual_wallet->credit(15);

            // subscribe user to the first package
            $package = Package::where('entry_package', 1)->first();
            if ($package) {
                PackageRepository::subscribeUserToPackage($deposit['user_id'], $package->id);
            }
        } elseif ($deposit['item_no'] === static::NORMAL_DEPOSIT) {

            // credit the user savings wallet
            $user = User::query()
                ->with(['saving_wallet'])
                ->where('id', $deposit['user_id'])
                ->first();

            if ($user && $user->saving_wallet) {
                $user->saving_wallet->credit($deposit['amount']);
            }
        } elseif ($deposit['item_no'] === static::PACKAGE_UPGRADE_DEPOSIT) {
            $user = User::query()
                ->with(['virtual_wallet'])
                ->where('id', $deposit['user_id'])
                ->first();

            $user->virtual_wallet->credit($deposit['amount']);

            $package_id = @explode(':', $deposit['item_name'])[1];
            if ($package_id) {
                PackageRepository::subscribeUserToPackage($deposit['user_id'], trim($package_id));
            }
        }
    }
}
