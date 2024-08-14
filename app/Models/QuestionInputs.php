<?php

namespace App\Models;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionInputs extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'label',
        'input_question'
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
}
