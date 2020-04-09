<?php

namespace App\Repositories;


use App\Coordinator;
use App\Director;
use App\Package;
use App\ProvideDonation;
use App\UserLeader;
use App\UserPackage;
use App\User;
use App\UserReferral;
use App\VirtualWallet;

class PackageRepository {


    public function __construct()
    {
    }


    public static function subscribeUserToPackage($user_id, $package_id)
    {
        $user = User::with(['virtual_wallet'])
            ->select(['id', 'name', 'is_pro_member', 'pro_member_through', 'state_id'])
            ->find($user_id);

        $package = Package::find($package_id);

        if (is_null($user) || is_null($package)) {
            return false;
        }

        if ($user->virtual_wallet->amount < $package->amount) {
            return false;
        }

        // check if user is subscribed to the package
        $subscribedToPackage = UserPackage::where('user_id', $user_id)
            ->where('package_id', $package_id)->first();

        if ($subscribedToPackage) {
            return false;
        }

        ProvideDonation::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'amount' => floatval($package->amount),
        ]);

        UserPackage::create([
            'user_id' => $user->id,
            'package_id' => $package->id
        ]);
        $user->virtual_wallet->debit($package->amount);

        $user->updateCurrentPackage($package->id);

        if ($user->pro_member_through == 'coupon') {
            return true;
        }

        $referral = UserReferral::query()
            ->with(['referral_user.virtual_wallet'])
            ->where('referred_user_id', $user_id)
            ->first();

        if ($referral && isset($referral->referral_user)) {
            $fivePercentOfPackageAmount = $package->amount * 0.10;
            $referral->referral_user->virtual_wallet->credit($fivePercentOfPackageAmount);
            activity()
                ->performedOn($referral->referral_user->virtual_wallet)
                ->causedBy($referral->referral_user)
                ->log('You received $'.number_format($fivePercentOfPackageAmount, 2).
                ' referral bonus from '. $user->name);
        }

        // check for leader
        $userLeader = UserLeader::where('user_id', $user->id)->first();
        if ($userLeader) {
            $leaderVirtualWallet = VirtualWallet::where('user_id', $userLeader->leader_id)->first();
            $leaderFivePercent = $package->amount * 0.05;
            $leaderVirtualWallet->credit($leaderFivePercent);
            activity()
                ->performedOn($leaderVirtualWallet)
                ->causedBy($leaderVirtualWallet->user_id)
                ->log('You received $'.number_format($leaderFivePercent, 2).
                    ' leader referral bonus from '. $user->name);
        }

        if ($user->state_id) {
            $stateCoordinator = Coordinator::where('state_id', $user->state_id)->first();
            if ($stateCoordinator) {
                $coordinatorVirtualWallet = VirtualWallet::where('user_id', $stateCoordinator->user_id)->first();
                $coordinatorThreePercent = $package->amount * 0.03;
                $coordinatorVirtualWallet->credit($coordinatorThreePercent);
                activity()
                    ->performedOn($coordinatorVirtualWallet)
                    ->causedBy($coordinatorVirtualWallet->user_id)
                    ->log('You received $'.number_format($coordinatorThreePercent, 2).
                        ' coordinator referral bonus from '. $user->name);


                // director referral bonus
                $director = Director::find($stateCoordinator->director_id);
                $directorVirtualWallet = VirtualWallet::where('user_id', $director->user_id)->first();
                $directorTwoPercent = $package->amount * 0.02;
                $directorVirtualWallet->credit($directorTwoPercent);

                activity()
                    ->performedOn($directorVirtualWallet)
                    ->causedBy($directorVirtualWallet->user_id)
                    ->log('You received $'.number_format($directorTwoPercent, 2).
                        ' director referral bonus from '. $user->name);
            }
        }
        // check for state coordinator
        // check for director
        // and add all referrals
        return true;
    }
}
