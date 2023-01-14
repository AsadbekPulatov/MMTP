<?php

namespace App\Http\Service;

class DateFormat
{
    public function date($from_date, $to_date){
//        dd($from_date, $to_date);
        $year = date('Y', strtotime($from_date));
        $month = date('m', strtotime($from_date));
        $day = date('d', strtotime($from_date));
        $date = $year."-йил";
        switch ($month){
            case "01": $month = __("messages.january"); break;
            case "02": $month = __("messages.february"); break;
            case "03": $month = __("messages.march"); break;
            case "04": $month = __("messages.april"); break;
            case "05": $month = __("messages.may"); break;
            case "06": $month = __("messages.june"); break;
            case "07": $month = __("messages.july"); break;
            case "08": $month = __("messages.august"); break;
            case "09": $month = __("messages.september"); break;
            case "10": $month = __("messages.october"); break;
            case "11": $month = __("messages.november"); break;
            case "12": $month = __("messages.december"); break;
        }
        $date = $date." ".$day."-".mb_strtoupper($month, 'UTF-8');
        $year = date('Y', strtotime($to_date));
        $month = date('m', strtotime($to_date));
        $day = date('d', strtotime($to_date));
        $date .= " дан ".$year."-йил";
        switch ($month){
            case "01": $month = __("messages.january"); break;
            case "02": $month = __("messages.february"); break;
            case "03": $month = __("messages.march"); break;
            case "04": $month = __("messages.april"); break;
            case "05": $month = __("messages.may"); break;
            case "06": $month = __("messages.june"); break;
            case "07": $month = __("messages.july"); break;
            case "08": $month = __("messages.august"); break;
            case "09": $month = __("messages.september"); break;
            case "10": $month = __("messages.october"); break;
            case "11": $month = __("messages.november"); break;
            case "12": $month = __("messages.december"); break;
        }
        $date = $date." ".$day."-".mb_strtoupper($month, 'UTF-8')." гача";
        return $date;
    }
}
