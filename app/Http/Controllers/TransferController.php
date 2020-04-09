<?php


namespace App\Http\Controllers;


use App\Processors\TransferProcessor;
use App\ProvideDonation;
use App\User;
use App\UserDebitWallet;
use App\UserReferral;
use App\UserSavingWallet;
use App\UserVirtualWithdrawal;
use App\VirtualWallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $saving_wallet = UserSavingWallet::query()
            ->where('user_id', auth()->user()->id)
            ->first();

        $virtual_wallet = VirtualWallet::query()
            ->where('user_id', auth()->user()->id)
            ->first();

        return view('transfer.index',[
            'saving_wallet_amount' => $saving_wallet->amount,
            'virtual_wallet_amount' => $virtual_wallet->amount,
            'override_transfer_limit' => ''
            ]);
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'from_wallet' => 'required',
            'to_wallet' => 'required',
            'amount' => 'required'
        ]);
        $postData = $request->input();

        if ($postData['from_wallet'] === $postData['to_wallet']) {
            flash()->error('You can\'t make a transfer to same wallet.');
            return back();
        }

        if ($postData['amount'] <= 0){
            flash()->error('Amount must be greater than zero. ');
            return back();
        }
        try {
            $transferProcessor = new TransferProcessor(auth()->user()->id);
            $transferProcessor->processTransfer($postData);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            flash()->error('The server encountered an error performing your request. Please notify the support team.');
        }
        return back();
    }
}
