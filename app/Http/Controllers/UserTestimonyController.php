<?php


namespace App\Http\Controllers;


use App\Testimony;
use Illuminate\Http\Request;

class UserTestimonyController extends Controller
{

    public function index()
    {
        $testimonies = Testimony::where('user_id', auth()->user()->id)
            ->get();

        return view('user_testimonies.index', compact('testimonies'));
    }

    public function create()
    {
        return view('user_testimonies.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'testimony' => 'required'
        ]);

        $data = $request->input();
        $data['user_id'] = auth()->user()->id;

        $testimony = Testimony::create($data);
        if ($testimony) {
            flash()->success('Testimony was successfully added');
        } else {
            flash()->error('Testimony could not be added');
        }
        return redirect()->route('user_testimonies:index');
    }
}
