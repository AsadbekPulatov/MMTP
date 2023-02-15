<?php

namespace App\Http\Controllers;

use App\Models\Tractor;
use Illuminate\Http\Request;

class TractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tractors = Tractor::all();
        return view('admin.tractors.index', compact('tractors'));
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
        Tractor::create($request->all());
        return redirect()->back()->with('success', __('messages.tractor_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tractor  $tractor
     * @return \Illuminate\Http\Response
     */
    public function show(Tractor $tractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tractor  $tractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tractor $tractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tractor  $tractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tractor $tractor)
    {
        $tractor = Tractor::find($request->id);
        $tractor->update($request->all());
        return redirect()->back()->with('success', __('messages.tractor_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tractor  $tractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tractor $tractor)
    {
        $tractor->delete();
        return redirect()->back()->with('success', __('messages.tractor_deleted'));
    }
}
