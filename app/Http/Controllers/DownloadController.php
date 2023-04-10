<?php

namespace App\Http\Controllers;

use App\Exports\ExportReport;
use App\Imports\ImportTest;
use App\Models\Office;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Service\Report as ReportService;
use App\Http\Service\DateFormat;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function workers(Request $request){
        $type = $request->type;
        $report = new ReportService();
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $worker_id = $request->worker_id;
        $report = $report->report(NULL,$worker_id,$from_date,$to_date, "none", "ASC");
        $workers = $report['data'];
        $sum = $report['sum'];
        $from_date = $report['from_date'];
        $to_date = $report['to_date'];
        $date = new DateFormat();
        $date = $date->date($from_date, $to_date);

        $office = Office::all()->first();

        if ($type == "xls"){
            $excel = new ExportReport($workers, $sum, $from_date, $to_date, $worker_id, $date, $office);
            return Excel::download($excel, "Иш хаки ({$from_date} {$to_date}).xlsx");
        }
        $pdf = Pdf::loadView('admin.download.worker',[
            'workers' => $workers,
            'sum' => $sum,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'worker_id' => $worker_id,
            'date' => $date,
            'office' => $office
        ])->setPaper('a4', 'landscape');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->download("Иш хаки ({$from_date} {$to_date}).pdf");
    }

    public function farmers(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        $farmer_id = $request->farmer_id;
        $report = new ReportService();
        $report = $report->report($farmer_id,$worker_id,$from_date,$to_date,"1", "ASC");
        $reports = $report['data'];
        $sum = $report['sum'];
        $page = $report['page'];
        $from_date = $report['from_date'];
        $to_date = $report['to_date'];

        $date = new DateFormat();
        $date = $date->date($from_date, $to_date);

        $pdf = Pdf::loadView('admin.download.farmer',
            compact('reports', 'page','sum',
                'from_date', 'to_date','worker_id','farmer_id','date'))->setPaper('a4', 'landscape');

        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        if ($page == "farmer"){
            $farmer = $reports[0]->farmer->name;
            return $pdf->download("{$farmer}({$from_date} {$to_date}).pdf");
        }
        if ($page == "worker"){
            $worker = $reports[0]->worker->name;
            return $pdf->download("{$worker}({$from_date} {$to_date}).pdf");
        }

    }
}
