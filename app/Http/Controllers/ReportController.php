<?php

namespace App\Http\Controllers;

use App\Http\Service\number_to_word;
use App\Models\Farmer;
use App\Models\Report;
use App\Models\Service;
use App\Models\Tractor;
use App\Models\Type;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Service\Report as ReportService;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function worker(Request $request)
    {
        $report = new ReportService();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        $report = $report->report(NULL,$worker_id,$from_date,$to_date);
        $workers = $report['data'];
        $sum = $report['sum'];
        return view('admin.reports.worker', compact('workers', 'sum','from_date','to_date','worker_id'));
    }

    public function index(Request $request)
    {
//        Log::error("Salom",[1,2,3]);
//        $ip = '10.1.28.142';
//        $ip = '37.110.215.45';
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        $farmer_id = $request->farmer_id;
        $report = new ReportService();
        $report = $report->report($farmer_id,$worker_id,$from_date,$to_date,"1");
        $reports = $report['data'];
        $sum = $report['sum'];
        $page = $report['page'];
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
        $request['weight'] = str_replace(',','.', $request['weight']);
        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', __("messages.report_created"));
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
        return redirect()->route('reports.index')->with('success', __("messages.report_updated"));
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
        return redirect()->route('reports.index')->with('success', __("messages.report_deleted"));
    }
}
