<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RavePayPaymentController extends Controller
{

    public function index()
    {
        return view('rave_payment.index');
    }
}
