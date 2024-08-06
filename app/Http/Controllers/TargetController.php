<?php

namespace App\Http\Controllers;

use App\Helpers\QuestionsHelper;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class TargetController extends Controller
{
    private $questionsHelper;

    public function __construct()
    {
        $this->questionsHelper = new QuestionsHelper();
    }

    public function index(Request $request)
    {
        $index = $request->query('index', 0);
        $allQuestions = collect($this->questionsHelper->flattenQuestions());
        $question = $allQuestions->map(function ($item) {
            return collect($item)->put('code', $item['code'],)
            ->put('weight', $this->questionsHelper->getWeight($item['code']));
        })->groupBy('criteria');

        $criteriaKeys = $question->keys()->all();
        $currentCriteria = $criteriaKeys[$index];

        $questionCounts = $question->map(function ($questions) {
            return $questions->count();
        });

        $answers = Target::where('user_id', 1)->get()->keyBy('question_id');

        return view('question.target', [
            'questions' => $question[$currentCriteria],
            'currentCriteria' => $currentCriteria,
            'questionCounts' => $questionCounts,
            'criteriaKeys' => $criteriaKeys,
            'currentIndex' => $index,
            'answers' => $answers,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $userId = 1;

        if (isset($data['answers'])) {
            foreach ($data['answers'] as $questionId => $answer) {
                if (is_array($answer)) {
                    foreach ($answer as $subKey => $subAnswer) {
                        if ($subAnswer !== null) {
                            Target::updateOrCreate(
                                [
                                    'user_id' => $userId,
                                    'question_id' => $questionId . '-' . $subKey
                                ],
                                [
                                    'target_answer' => $subAnswer
                                ]
                            );
                        }
                    }
                } else {
                    if ($answer !== null) {
                        Target::updateOrCreate(
                            [
                                'user_id' => $userId,
                                'question_id' => $questionId
                            ],
                            [
                                'target_answer' => $answer
                            ]
                        );
                    }
                }
            }
        }

        $nextIndex = $request->input('currentIndex') + 1;
        return redirect()->route('target.index', ['index' => $nextIndex]);
    }
}
