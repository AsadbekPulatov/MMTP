<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Service\Report as ReportService;

class DownloadController extends Controller
{
    public function workers(Request $request){
        $report = new ReportService();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $worker_id = $request->worker_id;
        $report = $report->report(NULL,$worker_id,$from_date,$to_date);
        $workers = $report['data'];
        $sum = $report['sum'];

        $year = date('Y', strtotime($from_date));
        $month = date('m', strtotime($from_date));
        switch ($month){
            case "01": $month = "Январь"; break;
            case "02": $month = "Феврал"; break;
            case "03": $month = "Март"; break;
            case "04": $month = "Апрел"; break;
            case "05": $month = "Май"; break;
            case "06": $month = "Июнь"; break;
            case "07": $month = "Июль"; break;
            case "08": $month = "Аугуст"; break;
            case "09": $month = "Сенябрь"; break;
            case "10": $month = "Октябрь"; break;
            case "11": $month = "Ноябрь"; break;
            case "12": $month = "Декабрь"; break;
        }
        $month = mb_strtoupper($month, 'UTF-8');
        $pdf = Pdf::loadView('admin.download.worker',[
            'workers' => $workers,
            'sum' => $sum,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'worker_id' => $worker_id,
            'year' => $year,
            'month'=>$month,
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
        $report = $report->report($farmer_id,$worker_id,$from_date,$to_date,"1");
        $reports = $report['data'];
        $sum = $report['sum'];
        $page = $report['page'];
        $year = date('Y', strtotime($from_date));
        $month = date('m', strtotime($from_date));
        switch ($month){
            case "01": $month = "Январь"; break;
            case "02": $month = "Феврал"; break;
            case "03": $month = "Март"; break;
            case "04": $month = "Апрел"; break;
            case "05": $month = "Май"; break;
            case "06": $month = "Июнь"; break;
            case "07": $month = "Июль"; break;
            case "08": $month = "Аугуст"; break;
            case "09": $month = "Сенябрь"; break;
            case "10": $month = "Октябрь"; break;
            case "11": $month = "Ноябрь"; break;
            case "12": $month = "Декабрь"; break;
        }
        $month = mb_strtoupper($month, 'UTF-8');

        $pdf = Pdf::loadView('admin.download.farmer',
            compact('reports', 'page','sum',
                'from_date', 'to_date','worker_id','farmer_id','year','month'))->setPaper('a4', 'landscape');

        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream("Фермер.pdf");
    }
}
