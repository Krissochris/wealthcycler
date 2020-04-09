<?php

namespace App\Repositories;

class PaymentGateWayRepository {

    CONST PAYMENT_GATEWAYS = [
        'pay_pal' => 'Paypal',
        'coin_payment' => 'Coin Payment',
        'rave_pay' => 'Rave Payment'
    ];

    public static function getPaymentGateways()
    {
        return static::PAYMENT_GATEWAYS;
    }
}