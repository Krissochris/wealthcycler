<?php

namespace App\Http\Controllers;

use App\VirtualMerges;
use Illuminate\Http\Request;

class VirtualMergesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->hasPermission('index_virtual_merge');

        $virtualMerges = VirtualMerges::query()
            ->with(['get_donation', 'provide_donation'])
            ->orderByDesc('created_at')
            ->get();

        return view('virtual_merges.index')->with(compact('virtualMerges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VirtualMerges  $virtualMerges
     * @return \Illuminate\Http\Response
     */
    public function show(VirtualMerges $virtualMerges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VirtualMerges  $virtualMerges
     * @return \Illuminate\Http\Response
     */
    public function edit(VirtualMerges $virtualMerges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VirtualMerges  $virtualMerges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VirtualMerges $virtualMerges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VirtualMerges  $virtualMerges
     * @return \Illuminate\Http\Response
     */
    public function destroy(VirtualMerges $virtualMerges)
    {
        //
    }
}
