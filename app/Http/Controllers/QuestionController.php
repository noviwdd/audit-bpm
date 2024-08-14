<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\QuestionsHelper;
use App\Models\Criteria;
use App\Models\QuestionChoices;
use App\Models\QuestionInputs;
use App\Models\Questions;
use App\Models\SubCriteria;

class QuestionController extends Controller
{
    protected $question;

    public function __construct()
    {
        $this->question = new QuestionsHelper;
    }

    public function index()
    {
        $questions = Questions::with(['subCriteria', 'subCriteria.criteria', 'choices', 'inputs'])->get();
        return view('management-question.index')->with('data', $questions);
    }

    public function create()
    {
        return view('management-question.edit');
    }

    public function edit($id = null)
    {
        $question = $id ? Questions::with('choices', 'inputs')->findOrFail($id) : new Questions();
        return view('management-question.edit', compact('question'));
    }

    public function store(Request $request, $id = null)
    {
        $question = Questions::updateOrCreate(
            ['id' => $id],
            [
                'main_question' => $request->main_question,
                'type' => $request->type,
            ]
        );

        if ($question->type === 'option') {
            $question->inputs()->delete();
            $question->choices()->delete();
            if (!empty($request->choices)) {
                foreach ($request->choices as $choice) {
                    $question->choices()->create($choice);
                }
            }
        } elseif ($question->type === 'input') {
            $question->choices()->delete();
            $question->inputs()->delete();
            if (!empty($request->inputs)) {
                foreach ($request->inputs as $input) {
                    $question->inputs()->create($input);
                }
            }
        }

        return redirect()->route('questions.index');
    }

    public function storeDumpData()
    {
        $flattenedQuestions = $this->question->flattenQuestions();

        foreach ($flattenedQuestions as $questionData) {
            $criteria = Criteria::firstOrCreate(['name' => $questionData['criteria']]);

            $subCriteria = SubCriteria::firstOrCreate([
                'name' => $questionData['subCriteria'],
                'criteria_id' => $criteria->id
            ]);

            $question = Questions::updateOrCreate([
                'code' => $questionData['code'],
            ],
            [
                'sub_criteria_id' => $subCriteria->id,
                'type' => $questionData['type'],
                'main_question' => $questionData['question']['main'] ?? $questionData['question'],
            ]);

            if ($questionData['type'] === 'option' && isset($questionData['choices'])) {
                foreach ($questionData['choices'] as $value => $description) {
                    QuestionChoices::updateOrCreate([
                        'question_id' => $question->id,
                        'value' => $value,
                    ],
                    [
                        'description' => $description,
                    ]);
                }
            }

            if ($questionData['type'] === 'input' && isset($questionData['question'])) {
                foreach ($questionData['question'] as $label => $details) {
                    if ($label !== 'main') { // Skip main question
                        // Cek apakah $details adalah array untuk menghindari error
                        if (is_array($details)) {
                            foreach ($details as $key => $value) {
                                // Gabungkan label dan key untuk keunikan, gunakan ternary operator
                                $uniqueLabel = $key !== null ? $label . '-' . $key : $label;

                                // Simpan detail
                                QuestionInputs::updateOrCreate(
                                    [
                                        'question_id' => $question->id,
                                        'label' => $uniqueLabel,
                                    ],
                                    [
                                        'input_question' => $value,
                                    ]
                                );
                            }
                        } else {
                            // Jika $details bukan array, simpan sebagai satu entri
                            QuestionInputs::updateOrCreate(
                                [
                                    'question_id' => $question->id,
                                    'label' => $label,
                                ],
                                [
                                    'input_question' => $details,
                                ]
                            );
                        }
                    }
                }
            }
        }

        return response()->json(['message' => 'Data saved successfully']);
    }
}
