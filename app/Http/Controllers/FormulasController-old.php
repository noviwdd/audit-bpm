<?php

namespace App\Http\Controllers;

use App\Helpers\FormulasHelper;
use App\Models\Achievement;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormulasController extends Controller
{
    protected $formula;

    public function __construct()
    {
        $this->formula = new FormulasHelper;
    }

    public function index()
    {
        return view('results.score');
    }

    public function generate()
    {
        $formulas = $this->formula->getFormula();

        $targetAnswers = Target::where('user_id', 1)->get()->keyBy('question_id');
        $achieveAnswers = Achievement::where('user_id', 1)->get()->keyBy('question_id');

        $targetResults = $this->processFormula($formulas, $targetAnswers, 'target_answer');
        $achieveResults = $this->processFormula($formulas, $achieveAnswers, 'achieve_answer');
        // return $achieveResults;

        return [
            'targetResults' => $targetResults,
            'achieveResults' => $achieveResults
        ];
    }

    public function processFormula($formulas, $answers, $answerKey)
    {
        $results = [];

        foreach ($formulas as $formulaKey => $questions) {
            $values = [];

            foreach ($questions as $question) {
                if (is_array($question)) {
                    foreach ($question as $q) {
                        if ($answers->has($q)) {
                            $values[] = $answers[$q]->$answerKey;
                        }
                    }

                    if ($formulaKey == 'formula2') {
                        $groupResults = [];
                        foreach ($questions as $group) {
                            $groupValues = [];
                            foreach ($group as $q) {
                                if (isset($answers[$q])) {
                                    $groupValues[] = $answers[$q]->$answerKey;
                                }
                            }

                            if (count($groupValues) == 2) {
                                $groupResults[] = $this->formula2($groupValues);
                            } else {
                                $groupResults[] = 'Data tidak lengkap';
                            }
                        }

                        $results[$formulaKey] = $groupResults;
                    } elseif ($formulaKey == 'formula3') {
                        $formulasValues = [];
                        foreach ($questions as $question) {
                            foreach ($question as $q) {
                                foreach ($answers as $questionId => $answer) {
                                    if (Str::startsWith($questionId, $q . '-')) {
                                        $key = substr($questionId, strrpos($questionId, '-') + 1);
                                        $formulasValues[$key] = $answer->$answerKey;
                                    }
                                }
                            }
                        }

                        if (count($formulasValues) >= 7) {
                            $results[$formulaKey] = $this->formula3($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula5') {
                        $formulasValues = [];
                        foreach ($questions as $question) {
                            foreach ($question as $q) {
                                foreach ($answers as $questionId => $answer) {
                                    if (Str::startsWith($questionId, $q . '-')) {
                                        $key = substr($questionId, strrpos($questionId, '-') + 1);
                                        $formulasValues[$key] = $answer->$answerKey;
                                    } elseif (Str::contains($questionId, $q)) {
                                        $key = substr($questionId, strrpos($questionId, '.') + 1);
                                        $formulasValues[$key] = $answer->$answerKey;
                                    }
                                }
                            }
                        }

                        if (count($formulasValues) >= 3) {
                            $results[$formulaKey] = $this->formula5($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula19') {
                        $groupResults = [];
                        foreach ($questions as $group) {
                            $groupValues = [];
                            foreach ($group as $q) {
                                if (isset($answers[$q])) {
                                    $groupValues[] = $answers[$q]->$answerKey;
                                }
                            }

                            if (count($groupValues) == 2) {
                                $groupResults[] = $this->formula19($groupValues);
                            } else {
                                $groupResults[] = 'Data tidak lengkap';
                            }
                        }

                        $results[$formulaKey] = $groupResults;
                    } elseif ($formulaKey == 'formula24') {
                        $groupResults = [];
                        foreach ($questions as $group) {
                            $groupValues = [];
                            foreach ($group as $q) {
                                if (isset($answers[$q])) {
                                    $groupValues[] = $answers[$q]->$answerKey;
                                }
                            }

                            if (count($groupValues) == 3) {
                                $groupResults[] = $this->formula24($groupValues);
                            } else {
                                $groupResults[] = 'Data tidak lengkap';
                            }
                        }

                        $results[$formulaKey] = $groupResults;
                    } elseif ($formulaKey == 'formula25') {
                        $groupResults = [];
                        foreach ($questions as $group) {
                            $groupValues = [];
                            foreach ($group as $q) {
                                if (isset($answers[$q])) {
                                    $groupValues[] = $answers[$q]->$answerKey;
                                }
                            }

                            if (count($groupValues) == 5) {
                                $groupResults[] = $this->formula25($groupValues);
                            } else {
                                $groupResults[] = 'Data tidak lengkap';
                            }
                        }

                        $results[$formulaKey] = $groupResults;
                    } elseif ($formulaKey == 'formula28') {
                        $formulasValues = [];
                        foreach ($questions as $question) {
                            foreach ($question as $q) {
                                foreach ($answers as $questionId => $answer) {
                                    if (Str::startsWith($questionId, $q . '-')) {
                                        $key = substr($questionId, strrpos($questionId, '-') + 1);
                                        $formulasValues[$key] = $answer->$answerKey;
                                    } elseif (Str::contains($questionId, $q)) {
                                        $key = substr($questionId, strrpos($questionId, '.') + 1);
                                        $formulasValues[$key] = $answer->$answerKey;
                                    }
                                }
                            }
                        }

                        if (count($formulasValues) >= 21) {
                            $results[$formulaKey] = $this->formula28($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    }
                } else {
                    if ($answers->has($question)) {
                        $values[] = $answers[$question]->$answerKey;
                    }

                    if ($formulaKey == 'formula1') {
                        $results[$formulaKey] = $this->formula1($values);
                    } elseif ($formulaKey == 'formula4') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula4($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula6') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula6($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula7') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula7($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula8') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 4) {
                            $results[$formulaKey] = $this->formula8($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula9') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula9($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula10') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula10($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula11') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula11($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula12') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula12($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula13') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula13($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula14') {
                        $groupResults = [];
                        foreach ($questions as $q) {
                            $formulasValues = [];
                            foreach ($answers as $questionId => $answer) {
                                if (Str::startsWith($questionId, $q . '-')) {
                                    $key = substr($questionId, strrpos($questionId, '-') + 1);
                                    $formulasValues[$key] = $answer->$answerKey;
                                }
                            }
                            if (count($formulasValues) >= 4) {
                                $groupResults[] = $this->formula14($formulasValues);
                            } else {
                                $groupResults[] = 'Data tidak lengkap';
                            }
                        }
                        $results[$formulaKey] = $groupResults;
                    } elseif ($formulaKey == 'formula15') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 11) {
                            $results[$formulaKey] = $this->formula15($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula16') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula16($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula17') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 5) {
                            $results[$formulaKey] = $this->formula17($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula20') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula20($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula21') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula21($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula22') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula22($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula26') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 2) {
                            $results[$formulaKey] = $this->formula26($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula27') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula27($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula29') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula29($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula30') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula30($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula31') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula31($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula32') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 4) {
                            $results[$formulaKey] = $this->formula32($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula33') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 4) {
                            $results[$formulaKey] = $this->formula33($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula34') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula34($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula35') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula35($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula36') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula36($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula37') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula37($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula38') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 1) {
                            $results[$formulaKey] = $this->formula38($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula39') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 5) {
                            $results[$formulaKey] = $this->formula39($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula40') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 30) {
                            $results[$formulaKey] = $this->formula40($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula41') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 11) {
                            $results[$formulaKey] = $this->formula41($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    } elseif ($formulaKey == 'formula42') {
                        $formulasValues = [];
                        foreach ($answers as $questionId => $answer) {
                            if (Str::startsWith($questionId, $question . '-')) {
                                $key = substr($questionId, strrpos($questionId, '-') + 1);
                                $formulasValues[$key] = $answer->$answerKey;
                            }
                        }

                        if (count($formulasValues) >= 4) {
                            $results[$formulaKey] = $this->formula42($formulasValues);
                        } else {
                            $results[$formulaKey] = 'Data tidak lengkap';
                        }
                    }
                }
            }
        }

        return response()->json($results);
    }


    public function formula1($values)
    {
        return $values;
    }

    public function formula2($values)
    {
        if (count($values) < 2) {
            return 'Data tidak dapat diproses.';
        }

        $a = $values[0];
        $b = $values[1];
        $skor = ($a + (2 * $b)) / 3;
        dd($skor);

        return $skor;
    }

    public function formula3($values)
    {
        $a = 3;
        $b = 2;
        $c = 1;

        $N1 = $values['N1'] ?? 0;
        $N2 = $values['N2'] ?? 0;
        $N3 = $values['N3'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RK = (($a * $N1) + ($b * $N2) + ($c * $N3)) / $NDTPS;
        } else {
            $RK = 0;
        }


        if ($RK >= 4) {
            $skorA = 4;
        } else {
            $skorA = $RK;
        }

        $a2 = 2;
        $b2 = 6;
        $c2 = 9;

        $NI = $values['NI'] ?? 0;
        $NN = $values['NN'] ?? 0;
        $NW = $values['NW'] ?? 0;

        if ($NI >= $a2) {
            $skorB = 4;
        } elseif ($NI < $a2 && $NN >= $b2) {
            $skorB = 3 + ($NI / $a2);
        } elseif (0 < $NI && $NI < $a2 && 0 < $NN && $NN < $b2) {
            $skorB = 2 + (2 * ($NI / $a2)) + ($NN / $b2) - (($NI * $NN) / ($a2 * $b2));
        } elseif ($NI == 0 && $NN == 0 && $NW >= $c2) {
            $skorB = 2;
        } elseif ($NI == 0 && $NN == 0 && $NW < $c2) {
            $skorB = (2 * $NW) / $c2;
        }

        $skor = ((2 * $skorA) + $skorB) / 3;

        return $skor;
    }

    public function formula4($values)
    {
        $JP = $values['JP'] ?? 0;
        $JPL = $values['JPL'] ?? 0;

        $rasio = $JPL / $JP;

        if ($rasio < 5) {
            $skor = (4 * $rasio) / 5;
        } else {
            $skor = 4;
        }

        return $skor;
    }

    public function formula5($values)
    {
        $skorA = $values['2A'];

        $NMA = $values['NMA'] ?? 0;
        $NMD = $values['NMD'] ?? 0;

        $PMA = $NMA / $NMD;

        if ($PMA < 1) {
            $skorB = 2 + (200 * $PMA);
        } else {
            $skorB = 4;
        }

        $skor = ((2 * $skorA) + $skorB) / 3;

        return $skor;
    }

    public function formula6($values)
    {
        $NDTPS = $values['NDTPS'] ?? 0;
        if ($NDTPS < 3) {
            $skor = 0;
        } elseif (3 <= $NDTPS && $NDTPS < 12) {
            $skor = ((2 * $NDTPS) + 12) / 9;
        } elseif ($NDTPS >= 12) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula7($values)
    {
        $NDS3 = $values['NDS3'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        $PDS3 = $NDS3 / $NDTPS * 100;

        if ($PDS3 < 50) {
            $skor = 2 + (4 * $PDS3) / 100;
        } elseif ($PDS3 >= 50) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula8($values)
    {
        $NDGB = $values['NDGB'] ?? 0;
        $NDLK = $values['NDLK'] ?? 0;
        $NDL = $values['NDL'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $PGBLKL = (($NDGB + $NDLK + $NDL) / $NDTPS) * 100;
        } else {
            $PGBLKL = 0;
        }

        if ($PGBLKL < 70) {
            $skor = 2 + ((20 * $PGBLKL) / 7) / 100;
        } elseif ($PGBLKL >= 70) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula9($values)
    {
        $NM = $values['NM'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        $RMD = $NM / $NDTPS;

        if ($RMD > 50) {
            $skor = 0;
        } elseif ($RMD < 25) {
            $skor = (4 * $RMD) / 25;
        } elseif (35 < $RMD && $RMD <= 50) {
            $skor = (200 - (4 * $RMD)) / 15;
        } elseif (25 <= $RMD && $RMD <= 35) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula10($values)
    {
        $RDPU = $values['RDPU'] ?? 0;
        if (6 < $RDPU && $RDPU <= 10) {
            $skor = 7 - ($RDPU / 2);
        } elseif ($RDPU <= 6) {
            $skor = 4;
        } elseif ($RDPU > 10) {
            $skor = 0;
        }

        return $skor;
    }

    public function formula11($values)
    {
        $REWMP = $values['REWMP'] ?? 0;

        if ($REWMP < 6 || $REWMP > 18) {
            $skor = 0;
        } elseif (6 <= $REWMP && $REWMP < 12) {
            $skor = ((2 * $REWMP) - 12) / 3;
        } elseif (16 < $REWMP && $REWMP <= 18) {
            $skor = 36 - (2 * $REWMP);
        } elseif (12 <= $REWMP && $REWMP <= 16) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula12($values)
    {
        $NDTT = $values['NDTT'] ?? 0;
        $NDT = $values['NDT'] ?? 0;

        if ($NDT > 0) {
            $PDTT = ($NDTT / ($NDT + $NDTT)) * 100;
        } else {
            $PDTT = 0;
        }


        if ($PDTT > 40) {
            $skor = 0;
        } elseif (10 < $PDTT && $PDTT <= 40) {
            $skor = (14 - (20 * ($PDTT / 100))) / 3;
        } elseif ($PDTT <= 10) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula13($values)
    {
        $NRD = $values['NRD'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RRD = $NRD / $NDTPS;
        } else {
            $RRD = 0;
        }

        if ($RRD < 0.5) {
            $skor = 2 + (4 * $RRD);
        } elseif ($RRD >= 0.5) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula14($values)
    {
        $a = 0.05;
        $b = 0.3;
        $c = 1;

        $NI = $values['NI'] ?? 0;
        $NN = $values['NN'] ?? 0;
        $NL = $values['NL'] ?? 0;
        $NDTPS = $values['NTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RI = $NI / 3 / $NDTPS;
            $RN = $NN / 3 / $NDTPS;
            $RL = $NL / 3 / $NDTPS;
        } else {
            $RI = 0;
            $RN = 0;
            $RL = 0;
        }


        if ($RI == 0 && $RN == 0 && $RL >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RL < $c) {
            $skor = (2 * $RL) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula15($values)
    {
        $a = 0.1;
        $b = 1;
        $c = 2;

        $NA1 = $values['NA1'] ?? 0;
        $NA2 = $values['NA2'] ?? 0;
        $NA3 = $values['NA3'] ?? 0;
        $NA4 = $values['NA4'] ?? 0;
        $NB1 = $values['NB1'] ?? 0;
        $NB2 = $values['NB2'] ?? 0;
        $NB3 = $values['NB3'] ?? 0;
        $NC1 = $values['NC1'] ?? 0;
        $NC2 = $values['NC2'] ?? 0;
        $NC3 = $values['NC3'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RW = ($NA1 + $NB1 + $NC1) / $NDTPS;
            $RN = ($NA2 + $NA3 + $NB2 + $NC2) / $NDTPS;
            $RI = ($NA4 + $NB3 + $NC3) / $NDTPS;
        } else {
            $RW = 0;
            $RN = 0;
            $RI = 0;
        }

        if ($RI == 0 && $RN == 0 && $RW >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RW < $c) {
            $skor = (2 * $RW) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula16($values)
    {
        $NAS = $values['NAS'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RS = $NAS / $NDTPS;
        } else {
            $RS = 0;
        }

        if ($RS < 0.5) {
            $skor = 2 + (4 * $RS);
        } else {
            $skor = 4;
        }

        return $skor;
    }

    public function formula17($values)
    {
        $NA = $values['NA'] ?? 0;
        $NB = $values['NB'] ?? 0;
        $NC = $values['NC'] ?? 0;
        $ND = $values['ND'] ?? 0;
        $NDTPS = $values['NDTPS'] ?? 0;

        if ($NDTPS > 0) {
            $RLP = (2 * ($NA + $NB + $NC) + $ND) / $NDTPS;
        } else {
            $RLP = 0;
        }

        if ($RLP < 1) {
            $skor = 2 + (2 * $RLP);
        } else {
            $skor = 4;
        }

        return $skor;
    }

    // public function formula18($values)
    // {

    // }

    public function formula19($values)
    {
        if (count($values) < 2) {
            return 'Data tidak lengkap';
        }

        $A = $values[0] ?? 0;
        $B = $values[1] ?? 0;

        return ($A + $B) / 2;
    }

    public function formula20($values)
    {
        $DOP = $values['DOP'] ?? 0;

        if ($DOP < 20) {
            $skor = $DOP / 5;
        } elseif ($DOP >= 20) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula21($values)
    {
        $DPD = $values['DPD'] ?? 0;

        if ($DPD < 10) {
            $skor = (2 * $DPD) / 5;
        } elseif ($DPD >= 10) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula22($values)
    {
        $DPkMD = $values['DPkMD'] ?? 0;

        if ($DPkMD < 5) {
            $skor = (4 * $DPkMD) / 5;
        } elseif ($DPkMD >= 5) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    // public function formula23($values)
    // {

    // }

    public function formula24($values)
    {
        if (count($values) < 3) {
            return 'Data tidak valid';
        }

        $A = $values[0] ?? 0;
        $B = $values[1] ?? 0;
        $C = $values[2] ?? 0;

        return ($A + (2 * $B) + (2 * $C)) / 5;
    }

    public function formula25($values)
    {
        if (count($values) < 5) {
            return 'Data tidak lengkap';
        }

        $A = $values[0] ?? 0;
        $B = $values[1] ?? 0;
        $C = $values[2] ?? 0;
        $D = $values[3] ?? 0;
        $E = $values[4] ?? 0;

        return ($A + (2 * $B) + (2 * $C) + (2 * $D) + (2 * $E)) / 9;
    }

    public function formula26($values)
    {
        $JP = $values['JP'] ?? 0;
        $JB = $values['JB'] ?? 0;

        if ($JB > 0) {
            $PJP = ($JP / $JB) * 100;
        } else {
            $PJP = 0;
        }

        if ($PJP < 20) {
            $skor = (20 * $PJP) / 100;
        } elseif ($PJP >= 20) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula27($values)
    {
        $NMKI = $values['NMKI'] ?? 0;

        if ($NMKI == 1) {
            $skor = 2;
        } elseif (($NMKI == 2) || ($NMKI == 3)) {
            $skor = 3;
        } elseif ($NMKI > 3) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula28($values)
    {
        // Mencari nilai A
        $tkms = [];

        for ($i = 1; $i <= 5; $i++) {
            $ai = isset($values["ai_$i"]) ? (int) $values["ai_$i"] : 0;
            $bi = isset($values["bi_$i"]) ? (int) $values["bi_$i"] : 0;
            $ci = isset($values["ci_$i"]) ? (int) $values["ci_$i"] : 0;
            $di = isset($values["di_$i"]) ? (int) $values["di_$i"] : 0;

            $tkm_i = ((4 * $ai) + (3 * $bi) + (2 * $ci) + $di) / 4;
            $tkms[] = $tkm_i;
        }
        $tkm = array_sum($tkms) / 5;

        if ($tkm < 25) {
            $skorA = 0;
        } elseif (25 < $tkm && $tkm < 75) {
            $skorA = (8 * $tkm) - 2;
        } elseif ($tkm >= 75) {
            $skorA = 4;
        }

        // Mencari nilai B
        $skorB = $values['10B'] ?? 0;

        $skor = ($skorA + (2 * $skorB)) / 3;

        return $skor;
    }

    public function formula29($values)
    {
        $NPM = $values['NPM'] ?? 0;
        $NPD = $values['NPD'] ?? 0;

        if ($NPD > 0) {
            $PPDM = ($NPM / $NPD) * 100;
        } else {
            $PPDM = 0;
        }

        if ($PPDM < 25) {
            $skor = 2 + (8 * $PPDM) / 100;
        } elseif ($PPDM >= 25) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }
        return $skor;
    }

    public function formula30($values)
    {
        $NPkMM = $values['NPkMM'] ?? 0;
        $NPkMD = $values['NPkMD'] ?? 0;

        if ($NPkMD > 0) {
            $PPkMDM = ($NPkMM / $NPkMD) * 100;
        } else {
            $PPkMDM = 0;
        }

        if ($PPkMDM < 25) {
            $skor = 2 + (8 * $PPkMDM) / 100;
        } elseif ($PPkMDM >= 25) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }
        return $skor;
    }

    public function formula31($values)
    {
        $RIPK = $values['RIPK'] ?? 0;

        if (2 <= $RIPK && $RIPK < 3.25) {
            $skor = ((8 * $RIPK) - 6) / 5;
        } elseif ($RIPK >= 3.25) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula32($values)
    {
        $NI = $values['NI'] ?? 0;
        $NN = $values['NN'] ?? 0;
        $NW = $values['NW'] ?? 0;
        $NM = $values['NM'] ?? 0;

        if ($NM > 0) {
            $RI = $NI / $NM * 100;
            $RN = $NN / $NM * 100;
            $RW = $NW / $NM * 100;
        } else {
            $RI = 0;
            $RN = 0;
            $RW = 0;
        }

        $a = 0.1;
        $b = 1;
        $c = 2;

        if ($RI == 0 && $RN == 0 && $RW >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RW < $c) {
            $skor = (2 * $RW) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula33($values)
    {
        $NI = $values['NI'] ?? 0;
        $NN = $values['NN'] ?? 0;
        $NW = $values['NW'] ?? 0;
        $NM = $values['NM'] ?? 0;

        if ($NM > 0) {
            $RI = $NI / $NM * 100;
            $RN = $NN / $NM * 100;
            $RW = $NW / $NM * 100;
        } else {
            $RI = 0;
            $RN = 0;
            $RW = 0;
        }

        $a = 0.2;
        $b = 2;
        $c = 4;

        if ($RI == 0 && $RN == 0 && $RW >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RW < $c) {
            $skor = (2 * $RW) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula34($values)
    {
        $MS = $values['MS'];

        if ($MS <= 3) {
            $skor = 0;
        } elseif (3 < $MS && $MS <= 3.5) {
            $skor = (8 * $MS) - 24;
        } elseif (4.5 < $MS && $MS <= 7) {
            $skor = (56 - (8 * $MS)) / 5;
        } elseif (3.5 < $MS && $MS <= 4.5) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula35($values)
    {
        $PTW = $values['PTW'] ?? 0;

        if ($PTW < 50) {
            $skor = 1 + (6 * $PTW);
        } elseif ($PTW >= 50) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula36($values)
    {
        $PPS = $values['PPS'] ?? 0;

        if (30 < $PPS & $PPS < 85) {
            $skor = ((80 * $PPS) - 24) / 11;
        } elseif ($PPS >= 85) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula37($values)
    {
        $WT = $values['WT'] ?? 0;

        if ($WT > 18) {
            $skor = 0;
        } elseif (6 <= $WT && $WT <= 18) {
            $skor = (18 - $WT) / 3;
        } elseif ($WT < 6) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula38($values)
    {
        $PBS = $values['PBS'] ?? 0;

        if ($PBS < 60) {
            $skor = (20 * $PBS) / 3;
        } elseif ($PBS >= 60) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }

    public function formula39($values)
    {
        $NI = $values['NI'] ?? 0;
        $NN = $values['NN'] ?? 0;
        $NW = $values['NW'] ?? 0;
        $NL = $values['NL'] ?? 0;
        $NJ = $values['NJ'] ?? 0;

        if ($NJ > 0) {
            $RI = ($NI / $NJ) * 100;
            $RN = ($NN / $NJ) * 100;
            $RW = ($NW / $NJ) * 100;
        } else {
            $RI = 0;
            $RN = 0;
            $RW = 0;
        }

        $a = 5;
        $b = 20;
        $c = 90;

        if ($RI == 0 && $RN == 0 && $RW >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RW < $c) {
            $skor = (2 * $RW) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        if ($NL > 0) {
            $PJ = ($NJ / $NL) * 100;
        } else {
            $PJ = 0;
        }

        if ($NL >= 300) {
            $Prmin = 30;
        } elseif ($NL < 300) {
            $Prmin = 50 - (($NL / 300) * 20);
        }

        if ($PJ >= $Prmin) {
            $skorAkhir = $skor;
        } elseif ($PJ < $Prmin) {
            $skorAkhir = ($PJ / $Prmin) * $skor;
        } else {
            $skorAkhir = 'Data tidak valid';
        }

        return $skorAkhir;
    }

    public function formula40($values)
    {
        $NJ = $values['NJ'] ?? 0;
        $NL = $values['NL'] ?? 0;

        $tkms = [];

        for ($i = 1; $i <= 7; $i++) {
            $ai = isset($values["ai_$i"]) ? (int) $values["ai_$i"] : 0;
            $bi = isset($values["bi_$i"]) ? (int) $values["bi_$i"] : 0;
            $ci = isset($values["ci_$i"]) ? (int) $values["ci_$i"] : 0;
            $di = isset($values["di_$i"]) ? (int) $values["di_$i"] : 0;

            $tkm_i = ((4 * $ai) + (3 * $bi) + (2 * $ci) + $di) / 100;
            $tkms[] = $tkm_i;
        }
        $skor = array_sum($tkms) / 7;

        if ($NL > 0) {
            $PJ = ($NJ / $NL) * 100;
        } else {
            $PJ = 0;
        }

        if ($NL >= 300) {
            $Prmin = 30;
        } elseif ($NL < 300) {
            $Prmin = 50 - (($NL / 300) * 20);
        }

        if ($PJ >= $Prmin) {
            $skorAkhir = $skor;
        } elseif ($PJ < $Prmin) {
            $skorAkhir = ($PJ / $Prmin) * $skor;
        }

        return $skorAkhir;
    }

    public function formula41($values)
    {
        $NA1 = $values['NA1'] ?? 0;
        $NA2 = $values['NA2'] ?? 0;
        $NA3 = $values['NA3'] ?? 0;
        $NA4 = $values['NA4'] ?? 0;
        $NB1 = $values['NB1'] ?? 0;
        $NB2 = $values['NB2'] ?? 0;
        $NB3 = $values['NB3'] ?? 0;
        $NC1 = $values['NC1'] ?? 0;
        $NC2 = $values['NC2'] ?? 0;
        $NC3 = $values['NC3'] ?? 0;
        $NM = $values['NM'] ?? 0;

        if ($NM > 0) {
            $RL = (($NA1 + $NB1 + $NC1) / $NM) * 100;
            $RN = (($NA2 + $NA3 + $NB2 + $NC2) / $NM) * 100;
            $RI = (($NA4 + $NB3 + $NC3) / $NM) * 100;
        } else {
            $RL = 0;
            $RN = 0;
            $RI = 0;
        }

        $a = 1;
        $b = 10;
        $c = 50;

        if ($RI == 0 && $RN == 0 && $RL >= $c) {
            $skor = 2;
        } elseif ($RI == 0 && $RN == 0 && $RL < $c) {
            $skor = (2 * $RL) / $c;
        } elseif ($RI < $a && $RN >= $b) {
            $skor = 3 + ($RI / $a);
        } elseif ((0 < $RI && $RI < $a && 0 < $RN && $RN < $b) || (0 < $RN && $RN < $b && $RI == 0) || (0 < $RI && $RI < $a && $RN == 0)) {
            $skor = 2 + (2 * ($RI / $a)) + ($RN / $b) - (($RI * $RN) / ($a * $b));
        } elseif ($RI >= $a) {
            $skor = 4;
        } else {
            $skor = 'Data tidak valid';
        }

        return $skor;
    }

    public function formula42($values)
    {
        $NA = $values['NA'] ?? 0;
        $NB = $values['NB'] ?? 0;
        $NC = $values['NC'] ?? 0;
        $ND = $values['ND'] ?? 0;

        $NLP = 2 * ($NA + $NB + $NC) + $ND;

        if ($NLP < 1) {
            $skor = 2 + (2 * $NLP);
        } elseif ($NLP >= 1) {
            $skor = 4;
        } else {
            return 'Data tidak valid';
        }

        return $skor;
    }
}
