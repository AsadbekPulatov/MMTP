<?php

namespace App\Http\Service;

use App\Models\Report as ReportModel;

class Report
{
    public function report($farmer_id, $worker_id, $from_date=Null, $to_date=Null, $page="none", $order_by="DESC"){
        if(!isset($from_date)){
            $from_date = ReportModel::orderby('start_date', 'ASC')->first();
            if(isset($from_date)){
                $from_date = $from_date->start_date;
            }
        }
        if(!isset($to_date)){
            $to_date = ReportModel::orderby('start_date', 'DESC')->first();
            if(isset($to_date)){
                $to_date = $to_date->start_date;
            }
        }
        if ($page == "none") {
            if (isset($worker_id))
                $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->whereIn('worker_id', $worker_id)->get();
            else $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->get();
            $arr = [];
            if (isset($reports)){
                foreach ($reports as $worker) {
                    $arr[$worker->worker_id]['data'] = [];
                    $arr[$worker->worker_id]['sum_staj'] = 0;
                    $arr[$worker->worker_id]['sum_price'] = 0;
                }
                foreach ($reports as $worker) {
                    if ($worker->start_date == $worker->end_date) {
                        $date = date('d.m.Y', strtotime($worker->start_date));
                    } else {
                        $date = date('d.m.Y', strtotime($worker->start_date)) . ' - ' . date('d.m.Y', strtotime($worker->end_date));
                    }


                    if ($worker->service->count){
                        $price = round($worker->service->price_worker / $worker->service->count, 2);
                        $staj = round($worker->weight / $worker->service->count, 1);
                    }else{
                        $price = 0;
                        $staj = 0;
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
                        'staj' => $staj,
                        'price_worker_oneday' => $price,
                        'price_worker_all' => round($price * $worker->weight, 2),
                        'date' => $date,
                    ];
                    $arr[$worker->worker_id]['sum_staj'] += $staj;
                    $arr[$worker->worker_id]['sum_price'] += round($price * $worker->weight, 1);
                }
                $sum['staj'] = array_sum(array_column($arr, 'sum_staj'));
                $sum['price'] = array_sum(array_column($arr, 'sum_price'));
            }
            return ['data' => $arr, 'sum' => $sum, 'from_date' => $from_date, 'to_date' => $to_date];
        }
        //reports.index
        else {
            $sum['staj'] = 0;
            $sum['price'] = 0;
            if (!isset($from_date)) {
                $reports = ReportModel::orderBy('start_date', $order_by)->get();
                $page = 'farmer';
            } else {
                if (isset($worker_id)) {
                    if (isset($farmer_id)) {
                        $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->where('worker_id', $worker_id)->where('farmer_id', $farmer_id)->get();
                    } else {
                        $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->where('worker_id', $worker_id)->get();
                    }
                    foreach ($reports as $report) {
                        $sum['staj'] += $report->weight;
                        $sum['price'] += $report->service->price * $report->weight;
                    }
                    $page = 'worker';
                } else {
                    if (isset($farmer_id)) {
                        $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->where('farmer_id', $farmer_id)->get();
                    } else
                        $reports = ReportModel::orderBy('start_date', $order_by)->whereBetween('start_date', [$from_date, $to_date])->get();
                    $page = 'farmer';
                }
            }
            return ['data' => $reports, 'sum' => $sum, 'page' => $page, 'from_date' => $from_date, 'to_date' => $to_date];
        }
    }

}
