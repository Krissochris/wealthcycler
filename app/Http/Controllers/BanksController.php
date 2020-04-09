<?php


namespace App\Http\Controllers;


use App\Bank;
use Illuminate\Http\Request;

class BanksController extends Controller
{

    public function index()
    {
        $banks = Bank::all();
        return view('banks.index', compact('banks'));
    }

    public function create()
    {
        return view('banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $bank = Bank::create($request->input());
        if ($bank) {
            flash()->success('Bank was successfully created');
        } else {
            flash()->error('Bank could not be added.');
        }
        return back();
    }

    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    public function update (Request $request, Bank $bank)
    {
        $request->validate([
            'name' => 'required'
        ]);
        if ($bank->update($request->input())) {
            flash()->success('Bank was successfully updated');
        } else {
            flash()->error('Bank could not be updated');
        }
        return back();
    }

    public function destroy(Bank $bank)
    {
        try {
            if ($bank->delete()) {
                flash()->success('Bank was successfully deleted');
            } else {
                flash()->error('Bank could not be deleted');
            }
        } catch (\Exception $exception) {
            flash()->error('An error occurred removing bank');
        }
        return back();
    }

}
