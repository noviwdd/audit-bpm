<?php

namespace App\Models;

use App\Models\Criteria;
use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'name'
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class, 'sub_criteria_id');
    }
}
