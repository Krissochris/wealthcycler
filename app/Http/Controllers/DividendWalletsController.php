<?php


namespace App\Http\Controllers;


use App\DividendWallet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DividendWalletsController extends Controller
{

    public function index()
    {
        $dividend_wallets = DividendWallet::query()
            ->with(['user'])
            ->get();

        return view('dividend_wallets.index')
            ->with(compact('dividend_wallets'));
    }


    public function showCreditWalletView()
    {
        // fetch all proper member that paid and not through coupon code

        $users = DividendWallet::query()
            ->whereRaw('(Select cycle_balance_received from dividend_wallet_cycles
            where dividend_wallet_cycles.dividend_wallet_id = dividend_wallets.id AND dividend_wallet_cycles.status = 1 LIMIT 1)
             < ?',[500])
            ->where('status', '1')
            ->get()
            ->pluck('user.name', 'user_id');

        return view('dividend_wallets.credit_wallet')
            ->with(compact('users'));
    }



    public function creditWallet(Request $request)
    {
        $this->validate($request, [
            'users_type' => 'required',
            'amount' => 'required|numeric'
        ]);

        if ($request->input('amount') <= 0) {
            flash()->error('Amount must be greater than 0');
            return back();
        }


        if ($request->input('users_type') === 'all_pro_members') {

            $dividend_wallets = DividendWallet::query()
                ->whereRaw('(Select cycle_balance_received from dividend_wallet_cycles
            where dividend_wallet_cycles.dividend_wallet_id = dividend_wallets.id AND dividend_wallet_cycles.status = 1 LIMIT 1)
             < ?',[500])
                ->where('status', 1)
                ->get();

            if ($dividend_wallets->count() <= 0) {
                flash()->error('No pro members found!');
                return back();
            }

            // actual amount for each user
            $actual_amount = $request->input('amount') / $dividend_wallets->count();

            $credited_dividend_wallet_count = 0;

            foreach ($dividend_wallets as $dividend_wallet) {
                if ($dividend_wallet->credit($actual_amount)) {
                    $credited_dividend_wallet_count += 1;
                }
            }
            if ($credited_dividend_wallet_count > 0) {
                flash()->success($credited_dividend_wallet_count .' pro members were successfully credited with $'. number_format($actual_amount, 2).' each.');
            } else {
                flash()->error('No proper member was successfully credited. Please try again');
            }

        } elseif ($request->input('users_type') === 'specific_user') {
            $post_user_id = $request->input('user_id');
            if (is_null($post_user_id) || empty($post_user_id)) {
                flash()->error('No specific user was selected.');
                return back();
            }

            $user = User::find($post_user_id);
            if (!$user) {
                flash()->error('User not found!.');
                return back();
            }
            $credited = $user->credit_dividend_wallet($request->input('amount'));
            if ($credited) {
                flash()->success($user->name. 'dividend wallet was successfully credited with the sum of $'. number_format($request->input('amount')));
            } else {
                flash()->error($user->name. ' dividend wallet could not be credited. Please try again.');
            }
        }
        return back();
    }



    public function edit(DividendWallet $dividendWallet)
    {
        return view('dividend_wallets.edit')
            ->with(compact('dividendWallet'));
    }

    public function update(Request $request, DividendWallet $dividendWallet)
    {
        $dividendWallet->fill($request->only(['status']));

        $updated = $dividendWallet->update();
        if ($updated) {
            $changes = $dividendWallet->getChanges();
            if ((int)$changes['status'] === -1) {
                // dividend wallet was suspended
                $dividendWallet->transactions()->create([
                    'description' => 'Your wallet was suspended.'
                ]);
            } elseif ((int)$changes['status'] === 1) {
                // dividend wallet was activated
                $dividendWallet->transactions()->create([
                    'description' => 'Your wallet was activated.'
                ]);
            }
            flash()->success('Dividend wallet was successfully updated');
        } else {
            flash()->error('Dividend wallet could not be updated.');
        }
        return back();
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $user = User::find($request->input('user_id'));
        $dividend_wallet = DividendWallet::query()
            ->where('user_id', $request->input('user_id'))
            ->first();

        if (is_null($dividend_wallet)) {
            if ($user->is_pro_member && $user->pro_member_through === User::PRO_MEMBER_TYPE_1) {
                $user->dividend_wallet()->create([
                    'is_active' => 1
                ]);
                flash()->success('User dividend wallet was successfully created.');
            } else {
                flash()->error('User is either not a pro member or became pro member through coupon.');
            }
        } else {
            flash()->success('User dividend wallet already exists!.');
        }

        return back();
    }
}
