<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'work_planning',
        'year',
        'target',
        'achieve',
        'time_target',
        'document',
        'index_position',
        'criteria_id',
        'sub_criteria_id',
        'evaluation_score',
        'evaluation_auto',
        'description',
    ];

    public function documents()
    {
        return $this->hasMany(PerformanceUnitDocument::class);
    }

    public function subCriteria()
    {
        return $this->belongsTo(SubCriteria::class);
    }
}
