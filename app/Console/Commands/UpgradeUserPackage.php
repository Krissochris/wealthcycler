<?php

namespace App\Console\Commands;

use App\Package;
use App\Repositories\PackageRepository;
use App\User;
use Illuminate\Console\Command;

class UpgradeUserPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade_user_package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrading the user package';

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
        // get all pro user with there wallet
        $users = User::with(['virtual_wallet'])
            ->where('is_pro_member', 1)
            ->get();

        if ($users->isEmpty()) {
            return ;
        }

        foreach ($users as $user) {
            $currentPackage = Package::find($user->current_virtual_package_id);
            if ($currentPackage && $currentPackage->next_package_id) {
                $nextPackage = Package::find($currentPackage->next_package_id);

                if (is_null($nextPackage)) {
                    continue;
                }
                if ($user->virtual_wallet->amount < $nextPackage->amount) {
                    continue;
                }
                PackageRepository::subscribeUserToPackage($user->id, $nextPackage->id);
            }
        }
    }
}
