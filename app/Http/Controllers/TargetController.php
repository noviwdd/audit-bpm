<?php

namespace App\Http\Controllers;

use App\Helpers\QuestionsHelper;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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

        $answers = Target::where('unit_id', Auth::user()->unit_id)->get()->keyBy('question_id');

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

        if (isset($data['answers'])) {
            foreach ($data['answers'] as $questionId => $answer) {
                if (is_array($answer)) {
                    foreach ($answer as $subKey => $subAnswer) {
                        if ($subAnswer !== null) {
                            Target::updateOrCreate(
                                [
                                    'unit_id' => Auth::user()->unit_id,
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
                                'unit_id' => Auth::user()->unit_id,
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

        $currentIndex = $request->input('currentIndex');
        $criteriaCount = count(collect($this->questionsHelper->flattenQuestions())->groupBy('criteria')->keys()->all());

        // Jika currentIndex adalah halaman terakhir, tetap di halaman yang sama
        if ($currentIndex < $criteriaCount - 1) {
            $nextIndex = $currentIndex + 1;
            return redirect()->route('target.index', ['index' => $nextIndex]);
        } else {
            return redirect()->route('target.index', ['index' => $currentIndex])->with('success', 'Data berhasil disimpan!');
        }
    }
}
