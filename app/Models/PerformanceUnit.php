<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'year',
        'target',
        'achieve',
        'time_target',
        'time_realize',
        'document',
        'evaluation_type',
        'description',
        'work_planing',
        'parent_id',
        'index_position'
    ];
}
