<?php


namespace App\Http\Controllers;


use App\MaintenanceFee;

class MaintenanceFeesController extends Controller
{

    public function index()
    {
        $maintenanceFees = MaintenanceFee::query()
            ->with(['get_donation', 'user', 'package'])
            ->get();

        return view('maintenance_fees.index', compact('maintenanceFees'));
    }

}
