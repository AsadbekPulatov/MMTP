<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Tractor;
use App\Models\Type;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('date', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tractors = Tractor::all();
        $types = Type::all();
        return view('admin.services.create', compact('tractors', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tractor_id = $request->input('tractor_id');
        $price = $request->input('price');
        $price_worker = $request->input('price_worker');
        $count = $request->input('count');
        foreach ($tractor_id as $key => $value) {
            $service = new Service();
            $service->name = $request->input('name');
            $service->type_id = $request->input('type_id');
            $service->date = $request->input('date');
            $service->tractor_id = $value;
            $service->price = $price[$key];
            $service->price_worker = floatval($price_worker[$key], 2);
            $service->count = $count[$key];
            $service->save();
        }
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $types = Type::all();
        return view('admin.services.edit', compact('service', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }
}
