<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceUnitDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'performance_unit_id',
        'file_path',
        'file_name',
    ];

    public function performanceUnit()
    {
        return $this->belongsTo(PerformanceUnit::class);
    }
}
