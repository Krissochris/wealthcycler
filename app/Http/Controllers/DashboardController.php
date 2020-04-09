<?php


namespace App\Http\Controllers;


use App\MaintenanceFee;
use App\User;
use App\Withdrawal;

class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalProUser = User::where('is_pro_member', 1)->count();
        $totalMaintenanceFees = MaintenanceFee::sum('amount');
        $totalActiveWithdrawals = Withdrawal::query()
            ->where('status', 1)->sum('amount');
        return view('dashboard.index', compact('totalUsers',
            'totalProUser', 'totalMaintenanceFees', 'totalActiveWithdrawals'));
    }
}
