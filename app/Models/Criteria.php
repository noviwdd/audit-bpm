<?php

namespace App\Models;

use App\Models\SubCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subcriteria()
    {
        return $this->hasMany(SubCriteria::class, 'criteria_id');
    }
}
