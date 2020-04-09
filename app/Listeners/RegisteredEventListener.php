<?php

namespace App\Listeners;

use App\Leader;
use App\Package;
use App\Processors\CouponCodeVerifyProcessor;
use App\ReferralLink;
use App\ReferralPyramid;
use App\Repositories\PackageRepository;
use App\User;
use App\UserLeader;
use App\UserReferral;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ReferralRelationship;

class RegisteredEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $userReferral = $this->getReferralUser();
        if ($userReferral instanceof Model) {
            $this->registerReferral($userReferral, $event->user);
        }
        // get the leader
        $this->assignLeader($event->user);
        $this->checkCouponCode($event->user);
    }

    protected function getOwnerOfRefCode($referral_username)
    {
        return User::query()
            ->select(['id', 'username'])
            ->where('username', $referral_username)
            ->first();
    }


    protected function getReferralUser()
    {
        if ($user = $this->getReferralByEmail()) {
            return $user;
        }
        if ($user = $this->getReferralByCookie()) {
            return $user;
        }
        return false;
    }

    protected function getReferralByEmail()
    {
        $referralEmail = request()->input('referral_email');
        if (empty($referralEmail)) {
            return false;
        }
        $user = User::query()->select(['id', 'email'])
            ->where('email', 'like', trim($referralEmail))
            ->first();
        if ($user) {
            return $user;
        }
        return false;
    }

    protected function getReferralByCookie()
    {
        $refUsername = request()->cookie('ref');
        if ($refUsername) {
            // find the user who referred
            return $this->getOwnerOfRefCode($refUsername);
        }
        return false;
    }


    protected function registerReferral($userReferredBy, $registeredUser)
    {
        UserReferral::create([
            'referral_user_id' => $userReferredBy->id,
            'referred_user_id' => $registeredUser->id
        ]);
    }

    protected function assignLeader($registeredUser)
    {
        $leader_id = null;
        if (request()->input('leader_id')) {
            $leader_id = request()->input('leader_id');
        } else {
            $leader = Leader::query()->where('default_selection', 1)->first();
            if ($leader) {
                $leader_id = $leader->id;
            }
        }

        if ($leader_id) {
            UserLeader::create([
                'user_id' => $registeredUser->id,
                'leader_id' => $leader_id,
            ]);
        }
    }

    protected function checkCouponCode($registeredUser)
    {
        // check if coupon was entered
        $coupon_code = request()->input('coupon_code');
        if (!empty($coupon_code)) {
            $couponVerifier = new CouponCodeVerifyProcessor('https://tyenorg.com');
            $return = $couponVerifier->verify($registeredUser->username, $coupon_code);

            if ($return === false) {
                flash()->error('An error occurred verifying your coupon code. Please try again');
            }

            if ($return) {
                $result_array = json_decode($return, true);
                if ($result_array['result'] === "ok") {

                    $registeredUser->makeProMember('coupon');
                    $registeredUser->virtual_wallet->credit(15);
                    $package = Package::where('entry_package', 1)->first();
                    if ($package) {
                        PackageRepository::subscribeUserToPackage($registeredUser->id, $package->id);
                    }

                    flash()->success("Coupon was successfully verified");
                } else {
                    flash()->error($result_array['message']);
                }
            }
        }

    }
}
