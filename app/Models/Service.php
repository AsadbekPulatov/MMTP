<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
        'date',
        'tractor_id',
        'price',
        'price_worker',
        'count',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function tractor()
    {
        return $this->belongsTo(Tractor::class);
    }
}
