<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'work_planning',
        'parent_id',
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
