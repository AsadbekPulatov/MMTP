<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'tractor_id',
        'farmer_id',
        'service_id',
        'weight',
        'start_date',
        'end_date',
    ];
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function tractor()
    {
        return $this->belongsTo(Tractor::class);
    }
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
