<?php

namespace App\Console\Commands;

use App\DividendWallet;
use App\User;
use Illuminate\Console\Command;

class CreateDividendWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_dividend_wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get all users in the system
        // create their a dividend wallet for them
        // if a user is a pro member and paid
        // activate the dividend wallet
        // else leave it as none active

        $users = User::query()->get();

        if ($users->isEmpty()) {
            $this->error('No users found!');
            return;
        }

        $wallet_created_count = 0;

        foreach ($users as $user) {
            $dividend_wallet = DividendWallet::query()
                ->where('user_id', $user->id)
                ->first();
            if (is_null($dividend_wallet)) {
                if ($user->is_pro_member && $user->pro_member_through === User::PRO_MEMBER_TYPE_1) {
                    if ($dividend_wallet = $user->dividend_wallet()->create([
                        'is_active' => 1
                    ])) {
                        //$dividend_wallet->dividend_wallet_cycles()->create();
                        $wallet_created_count += 1;
                    }
                }
                /*else {
                    if ($user->dividend_wallet()->create([
                        'is_active' => 0
                    ])) {
                        $wallet_created_count += 1;
                    }
                }*/
            }
        }
        $this->comment('Operation Completed: Total of '. $wallet_created_count.' dividend wallets was created.');
    }
}
