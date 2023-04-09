<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReport implements FromView
{
    private $workers;
    private $sum;
    private $from_date;
    private $to_date;
    private $worker_id;
    private $date;
    private $office;

    public function __construct($workers, $sum, $from_date, $to_date, $worker_id, $date, $office)
    {
        $this->workers = $workers;
        $this->sum = $sum;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->worker_id = $worker_id;
        $this->date = $date;
        $this->office = $office;
    }

    public function view(): View
    {
        return view('admin.download.worker',[
            'workers' => $this->workers,
            'sum' => $this->sum,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'office' => $this->office
        ]);
    }
}
