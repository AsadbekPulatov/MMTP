<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Report;
use App\Models\Service;
use App\Models\Tractor;
use App\Models\Type;
use App\Models\Worker;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function worker(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        if (!isset($from_date)) {
            $workers = Report::orderBy('start_date', 'DESC')->get();
        } else {
            if (isset($worker_id))
                $workers = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->whereIn('worker_id', $worker_id)->get();
            else $workers = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->get();
        }
        $arr = [];
        foreach ($workers as $worker) {
            $arr[$worker->worker_id]['data'] = [];
            $arr[$worker->worker_id]['sum_staj'] = 0;
            $arr[$worker->worker_id]['sum_price'] = 0;
        }
        foreach ($workers as $worker) {
            if ($worker->start_date == $worker->end_date) {
                $date = date('d.m.Y', strtotime($worker->start_date));
            } else {
                $date = date('d.m.Y', strtotime($worker->start_date)) . ' - ' . date('d.m.Y', strtotime($worker->end_date));
            }
            $arr[$worker->worker_id]['data'][] = [
                'id' => $worker->id,
                'worker' => $worker->worker->name,
                'farmer' => $worker->farmer->name,
                'service' => $worker->service->name,
                'tractor' => $worker->tractor->name,
                'type' => $worker->service->type->type,
                'count' => $worker->service->count,
                'weight' => $worker->weight,
                'price_worker' => $worker->service->price_worker,
                'staj' => round($worker->weight / $worker->service->count, 1),
                'price_worker_oneday' => round($worker->service->price_worker / $worker->service->count, 2),
                'price_worker_all' => round(round($worker->service->price_worker / $worker->service->count, 2) * $worker->weight, 1),
                'date' => $date,
            ];
            $arr[$worker->worker_id]['sum_staj'] += round($worker->weight / $worker->service->count, 1);
            $arr[$worker->worker_id]['sum_price'] += round(round($worker->service->price_worker / $worker->service->count, 2) * $worker->weight, 1);
        }
        $sum['staj'] = array_sum(array_column($arr, 'sum_staj'));
        $sum['price'] = array_sum(array_column($arr, 'sum_price'));
        $workers = $arr;
        return view('admin.reports.worker', compact('workers', 'sum','from_date','to_date','worker_id'));
    }

    public function index(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        $farmer_id = $request->farmer_id;
        $sum['staj'] = 0;
        $sum['price'] = 0;
        if (!isset($from_date)) {
            $reports = Report::orderBy('start_date', 'DESC')->get();
            $page = 'farmer';
        } else {
            if (isset($worker_id)) {
                if (isset($farmer_id)) {
                    $reports = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->where('worker_id', $worker_id)->where('farmer_id', $farmer_id)->get();
                } else {
                    $reports = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->where('worker_id', $worker_id)->get();
                }

                foreach ($reports as $report) {
                    $sum['staj'] += $report->weight;
                    $sum['price'] += $report->service->price * $report->weight;
                }
                $page = 'worker';
            } else {
                if (isset($farmer_id)) {
                    $reports = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->where('farmer_id', $farmer_id)->get();
                } else
                    $reports = Report::orderBy('start_date', 'DESC')->whereBetween('start_date', [$from_date, $to_date])->get();
                $page = 'farmer';
            }
        }
        return view('admin.reports.index', compact('reports', 'page','sum', 'from_date', 'to_date','worker_id','farmer_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workers = Worker::all();
        $tractors = Tractor::all();
        $farmers = Farmer::all();
        $services = Service::orderby('date', 'desc')->get();
        $types = Type::all()->pluck('type', 'id');
        return view('admin.reports.create', compact('workers', 'tractors', 'farmers', 'services', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $workers = Worker::all();
        $tractors = Tractor::all();
        $farmers = Farmer::all();
        $services = Service::orderby('date', 'desc')->get();
        $types = Type::all()->pluck('type', 'id');
        return view('admin.reports.edit', compact('report', 'workers', 'tractors', 'farmers', 'services', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $report->update($request->all());
        return redirect()->route('reports.index')->with('success', 'Report updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully');
    }
}
