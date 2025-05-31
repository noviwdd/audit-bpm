<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'weight'
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
}
