<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_package');

        $packages = Package::query()
            ->with(['next_package'])
            ->get()
            ->all();
        return view('packages.index')->with(compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->hasPermission('add_package');

        $packages = Package::pluck('name', 'id')->prepend('--Select Next Package--', '');
        return view('packages.create')->with(compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('add_package');

        $request->validate([
           'name' => 'required',
            'amount' => 'required',
        ]);
        // check if a package is already entry package
        $entryPackageAlreadyExists = Package::query()
            ->where('entry_package', 1)->first();

        $requestData = $request->only([
            'name', 'description', 'amount', 'entry_package', 'auto_upgrade',
            'next_package_id'
        ]);

        if ($entryPackageAlreadyExists) {
            $requestData['entry_package'] = 0;
            flash()->info('Package could not be selected as entry package because another package already exists as an entry package');
        }
        if (Package::create($requestData)) {
            flash()->success('Package was successfully created!');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $this->hasPermission('show_package');

        return view('packages.show')->with(compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $this->hasPermission('edit_package');

        $packages = Package::pluck('name', 'id')->prepend('--Select Next Package--', '');
        return view('packages.edit')->with(compact('package', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $this->hasPermission('edit_package');

        $request->validate([
            'name' => 'required',
            'amount' => 'required',
        ]);
        if ($package->update($request->only([
            'name', 'description', 'amount', 'entry_package', 'auto_upgrade',
            'next_package_id'
        ]))) {
            flash()->success('Package was successfully updated!');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $this->hasPermission('delete_package');

        // before delete dissociate from the any association with
        //other packages
        if ($package->delete()) {
            flash()->success('Package was successfully deleted!');
        } else {
            flash()->error('Package could not be deleted. Please try again later.');
        }
        return back();
    }
}
