<?php

namespace App\Models;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionChoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'value',
        'description'
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
}
