<?php

namespace App\Http\Controllers;

use App\Helpers\QuestionsHelper;
use App\Models\Achievement;
use App\Models\Target;
use Illuminate\Http\Request;

class AchievementController extends Controller
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

        $answers = Achievement::get()->keyBy('question_id');
        $target = Target::get()->keyBy('question_id');

        $answeredCount = $answers->filter(function ($answer, $key) use ($question, $currentCriteria) {
            return $question[$currentCriteria]->contains(function ($question) use ($key) {
                return strpos($key, $question['code']) === 0;
            });
        })->count();

        return view('question.achievement', [
            'questions' => $question[$currentCriteria],
            'currentCriteria' => $currentCriteria,
            'questionCounts' => $questionCounts,
            'criteriaKeys' => $criteriaKeys,
            'currentIndex' => $index,
            'answers' => $answers,
            'target' => $target,
            'answeredCount' => $answeredCount
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
                            Achievement::updateOrCreate(
                                [
                                    'user_id' => $userId,
                                    'question_id' => $questionId . '-' . $subKey
                                ],
                                [
                                    'achieve_answer' => $subAnswer
                                ]
                            );
                        }
                    }
                } else {
                    if ($answer !== null) {
                        Achievement::updateOrCreate(
                            [
                                'user_id' => $userId,
                                'question_id' => $questionId
                            ],
                            [
                                'achieve_answer' => $answer
                            ]
                        );
                    }
                }
            }
        }

        $nextIndex = $request->input('currentIndex') + 1;
        return redirect()->route('achievement.index', ['index' => $nextIndex]);
    }
}
