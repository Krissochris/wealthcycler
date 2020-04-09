<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PagesController extends Controller
{

    protected $pages = [
      'page_about_us' => 'About Us',
        'page_contact_us' => 'Contact Us',
      'page_terms_&_conditions' => 'Terms & Conditions',
        'page_disclaimer' => 'Disclaimer',
        'page_scuml_disclosure_&_agreement' => 'SCUML Disclosure & Agreement',
        'page_refund_policy' => 'Refund Policy',
        'page_privacy_policy' => 'Privacy Policy',
        'page_become_an_affiliate' => 'Become an Affiliate',
        'page_values_to_expect' => 'Values to Expect',
    ];

    public function index()
    {

        return view('settings.pages.index', ['pages' => $this->pages]);
    }

    public function edit($page)
    {
        if (!in_array( $page,array_keys($this->pages))) {
            abort(404);
        }
        return view('settings.pages.edit', ['page' => $page]);
    }

    public function update(Request $request, $page)
    {
        if (!in_array( $page,array_keys($this->pages))) {
            abort(404);
        }
        $page_data = $request->input($page);
        if (!empty($page_data)) {
            setting([$page => $page_data]);
        }
        setting()->save();
        flash( sprintf('%s has been updated!', $page), 'success');
        return back();
    }

    public function view($page)
    {
        if (!in_array( $page,array_keys($this->pages))) {
            abort(404);
        }
        return view('pages.view', ['page' => $page]);
    }
}
