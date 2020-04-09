<?php


namespace App\Http\Controllers;



use App\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{

    public function index()
    {
        $faqs = Faq::all();

        return view('faqs.index', compact('faqs'));
    }


    public function create()
    {
        $status = [
            1 => 'Published',
            0 => 'Unpublished',
        ];

        return view('faqs.create', compact('status'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create($request->input());

        if ($faq) {
            flash('Faq was successfully saved')->success();
        } else {
            flash( 'Faq could not be saved.Please try again')->error();
        }
        return back();
    }



    public function edit(Faq $faq)
    {
        $status = [
            1 => 'Published',
            0 => 'Unpublished',
        ];

        return view('faqs.edit', compact('faq', 'status'));
    }


    public function update(Request $request, Faq $faq)
    {
        $this->validate($request,[
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = $faq->update($request->input());

        if ($faq) {
            flash( 'Faq was successfully updated')->success();
        } else {
            flash( 'Faq could not be updated.Please try again')->error();
        }
        return back();
    }


    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            flash('Faq was successfully deleted')->success();
        } else {
            flash('Faq could not be deleted.Please try again')->error();
        }
        return back();
    }

}
