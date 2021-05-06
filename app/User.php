<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    CONST PRO_MEMBER_TYPE_1 = 'payment';
    CONST PRO_MEMBER_TYPE_2 = 'coupon';


    CONST PRO_MEMBER_THROUGH = [
        'payment',
        'coupon'
    ];


    CONST status = [
        1 => 'active',
        0 => 'unActive',
        -1 => 'blocked'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'phone_number', 'city', 'state_id',
        'country_id', 'overseer', 'status', 'is_pro_member', 'became_pro_member_at', 'pro_member_through',
        'current_virtual_package_id', 'override_virtual_withdrawal_restriction',
        'override_referral_limit_in_virtual_transfer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot() {
        parent::boot();

        static::created(function ($user) {
            $user->virtual_wallet()->create();
            $user->debit_wallet()->create();
            $user->saving_wallet()->create();
            $user->payment_detail()->create();
        });


        static::deleting(function($user) { // before delete() method call this
            $user->virtual_wallet()->delete();
            $user->debit_wallet()->delete();
            $user->saving_wallet()->delete();
            $user->payment_detail()->delete();
        });
    }

    public function provide_donations()
    {
        return $this->hasMany(ProvideDonation::class);
    }

    public function get_donations()
    {
        return $this->hasMany(GetDonation::class);
    }


    public function virtual_wallet()
    {
        return $this->hasOne(VirtualWallet::class);
    }

    public function debit_wallet()
    {
        return $this->hasOne(UserDebitWallet::class);
    }


    public function saving_wallet()
    {
        return $this->hasOne(UserSavingWallet::class);
    }

    public function payment_detail()
    {
        return $this->hasOne(UserPaymentDetail::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }



    public function is_pro_member()
    {
        return ($this->is_pro_member) ? true : false;
    }


    public function makeProMember($pro_member_via)
    {
        if (!in_array($pro_member_via, ['payment', 'coupon'])) {
            throw new \InvalidArgumentException(sprintf('Pro member via %s is not a valid type', $pro_member_via));
        }
        $this->forceFill([
            'is_pro_member' => 1,
            'pro_member_through' => $pro_member_via,
            'became_pro_member_at' => now()
        ]);
        if ($this->update()) {
            if ($this->pro_member_through === static::PRO_MEMBER_TYPE_1) {
                if ($this->dividend_wallet === NULL) {
                    $this->dividend_wallet()->create([
                        'is_active' => 1
                    ]);
                }
            }
            return true;
        }
        return false;
    }


    public function updateCurrentPackage($package_id)
    {
        if(is_numeric($package_id)) {
            $this->forceFill([
                'current_virtual_package_id' => intval($package_id)
            ]);
            return $this->update();
        }
        return false;
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function dividend_wallet()
    {
        return $this->hasOne(DividendWallet::class, 'user_id', 'id');
    }

    public function credit_dividend_wallet($amount)
    {
        return $this->dividend_wallet->credit($amount);
    }
}
