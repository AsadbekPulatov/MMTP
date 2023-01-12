<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function workers(Request $request){
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

        $year = date('Y', strtotime($worker->start_date));
        $month = date('m', strtotime($worker->start_date));
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
        $month = strtoupper($month);
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
}
