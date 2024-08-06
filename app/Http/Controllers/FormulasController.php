<?php

namespace App\Http\Controllers;

use App\Helpers\FormulasHelper;
use App\Helpers\QuestionsHelper;
use App\Models\Achievement;
use App\Models\Score;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class FormulasController extends Controller
{
    protected $formula;
    protected $question;

    public function __construct()
    {
        $this->formula = new FormulasHelper;
        $this->question = new QuestionsHelper;
    }

    public function index()
    {
        $weightedScore = $this->weightedScore();
        $predAccreditation = $this->predAccreditation();
        $score = Score::where('unit_id', 1)->get()->keyBy('question_id');
        // return $score['IBIK-STD-02.4A']->target_score;

        return view('results.score')->with([
            'weightedScore' => $weightedScore,
            'predAccreditation' => $predAccreditation,
            'score' => $score
        ]);
    }

    public function generate()
    {
        $formulas = $this->formula->getFormula();

        $targetAnswers = Target::where('user_id', 1)->get()->keyBy('question_id');
        $achieveAnswers = Achievement::where('user_id', 1)->get()->keyBy('question_id');

        $targetResults = $this->processFormula($formulas, $targetAnswers);
        $achieveResults = $this->processFormula($formulas, $achieveAnswers);

        $results = [
            'targetResults' => $targetResults,
            'achieveResults' => $achieveResults
        ];

        foreach ($results['targetResults'] as $key => $targetValue) {
            $achieveValue = Arr::get($achieveResults, $key);
            Score::updateOrCreate(
                [
                    'unit_id' => 1,
                    'question_id' => $key,
                ],
                [
                    'target_score' => $targetValue,
                    'achieve_score' => $achieveValue
                ]);
        }

        return redirect('/skor');
    }

    public function predAccreditation()
    {
        $weights = $this->weightedScore();
        $formulas = $this->formula->getFormula();
        $bobot = $this->question->getAllWeights();

        $predAccreditation = [];
        $maxPredAccreditation = [];
        foreach (($formulas['formula2']) as $formula) {
            if (isset($weights[$formula[0]]) && isset($weights[$formula[1]])) {
                $a = $weights[$formula[0]];
                $b = $weights[$formula[1]];
                $key = substr($formula[0], 0, -1);
                $predAccreditation[$key] = $this->formula2($a, $b);
                $maxPredAccreditation[$key] = $this->formula2(($bobot[$formula[0]] * 4), ($bobot[$formula[1]] * 4));
                unset($weights[$formula[0]], $weights[$formula[1]]);
                unset($bobot[$formula[0]], $bobot[$formula[1]]);
            }
        }

        if (isset($weights['IBIK-STD-02.4A']) && isset($weights['IBIK-STD-02.4B'])) {
            $a = $weights['IBIK-STD-02.4A'];
            $b = $weights['IBIK-STD-02.4B'];
            $predAccreditation['IBIK-STD-02.4'] = ((2 * $a) + $b)/3;
            $maxPredAccreditation['IBIK-STD-02.4'] = ((2 * $bobot['IBIK-STD-02.4A']) + $bobot['IBIK-STD-02.4B']) / 3;
            unset($weights['IBIK-STD-02.4A'], $weights['IBIK-STD-02.4B']);
            unset($bobot['IBIK-STD-02.4A'], $bobot['IBIK-STD-02.4B']);
        }

        if (isset($weights['IBIK-STD-03.2A']) && isset($weights['IBIK-STD-03.2B'])) {
            $a = $weights['IBIK-STD-03.2A'];
            $b = $weights['IBIK-STD-03.2B'];
            $predAccreditation['IBIK-STD-03.2'] = $this->formula5($a, $b);
            $maxPredAccreditation['IBIK-STD-03.2'] = ((2 * $bobot['IBIK-STD-03.2A']) + $bobot['IBIK-STD-03.2B']) / 3;
            unset($weights['IBIK-STD-03.2A'], $weights['IBIK-STD-03.2B']);
            unset($bobot['IBIK-STD-03.2A'], $bobot['IBIK-STD-03.2B']);
        }

        foreach (($formulas['formula19']) as $formula) {
            if (isset($weights[$formula[0]]) && isset($weights[$formula[1]])) {
                $a = $weights[$formula[0]];
                $b = $weights[$formula[1]];
                $key = substr($formula[0], 0, -1);
                $predAccreditation[$key] = $this->formula19($a, $b);
                $maxPredAccreditation[$key] = $this->formula19(($bobot[$formula[0]] * 4), ($bobot[$formula[1]] * 4));
                unset($weights[$formula[0]], $weights[$formula[1]]);
                unset($bobot[$formula[0]], $bobot[$formula[1]]);
            }
        }

        foreach (($formulas['formula24']) as $formula) {
            if (isset($weights[$formula[0]]) && isset($weights[$formula[1]])&& isset($weights[$formula[2]])) {
                $a = $weights[$formula[0]];
                $b = $weights[$formula[1]];
                $c = $weights[$formula[2]];
                $key = substr($formula[0], 0, -1);
                $predAccreditation[$key] = $this->formula24($a, $b, $c);
                $maxPredAccreditation[$key] = $this->formula24(($bobot[$formula[0]] * 4), ($bobot[$formula[1]] * 4), ($bobot[$formula[2]] * 4));
                unset($weights[$formula[0]], $weights[$formula[1]], $weights[$formula[2]]);
                unset($bobot[$formula[0]], $bobot[$formula[1]], $bobot[$formula[2]]);
            }
        }

        foreach (($formulas['formula25']) as $formula) {
            if (isset($weights[$formula[0]]) && isset($weights[$formula[1]]) && isset($weights[$formula[2]]) && isset($weights[$formula[3]]) && isset($weights[$formula[4]])) {
                $a = $weights[$formula[0]];
                $b = $weights[$formula[1]];
                $c = $weights[$formula[2]];
                $d = $weights[$formula[3]];
                $e = $weights[$formula[4]];
                $key = substr($formula[0], 0, -1);
                $predAccreditation[$key] = $this->formula25($a, $b, $c, $d, $e);
                $maxPredAccreditation[$key] = $this->formula25(($bobot[$formula[0]] * 4), ($bobot[$formula[1]] * 4), ($bobot[$formula[2]] * 4), ($bobot[$formula[3]] * 4), ($bobot[$formula[4]] * 4));
                unset($weights[$formula[0]], $weights[$formula[1]], $weights[$formula[2]], $weights[$formula[3]], $weights[$formula[4]]);
                unset($bobot[$formula[0]], $bobot[$formula[1]], $bobot[$formula[2]], $bobot[$formula[3]], $bobot[$formula[4]]);
            }
        }

        foreach (($formulas['formula28']) as $formula) {
            if (isset($weights[$formula[0]]) && isset($weights[$formula[1]])) {
                $a = $weights[$formula[0]];
                $b = $weights[$formula[1]];
                $key = substr($formula[0], 0, -1);
                $predAccreditation[$key] = $this->formula28($a, $b);
                $maxPredAccreditation[$key] = $this->formula28(($bobot[$formula[0]] * 4), ($bobot[$formula[1]] * 4));
                unset($weights[$formula[0]], $weights[$formula[1]]);
                unset($bobot[$formula[0]], $bobot[$formula[1]]);
            }
        }

        foreach ($weights as $key => $value) {
            $predAccreditation[$key] = $value;
        }

        foreach ($bobot as $key => $value) {
            $maxPredAccreditation[$key] = $value*4;
        }

        return [
            $predAccreditation,
            $maxPredAccreditation
        ];
    }

    public function weightedScore()
    {
        $questionCode = collect($this->question->flattenQuestions())->pluck('code');
        $data = [];

        foreach ($questionCode as $question) {
            $weightQuestion = $this->question->getWeight($question);
            $score = Score::where('question_id', $question)->first();

            if ($score) {
                $achieveScore = $score->achieve_score;
                $weightedScore = $achieveScore * $weightQuestion;
                $data[$question] = $weightedScore;
            } else {
                $data[$question] = null;
            }
        }

        return $data;
    }

    public function processFormula(Collection $formulas, $answers)
    {
        $results = [];

        // Formula 1
        $formula1Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula1'));
        });

        foreach ($formula1Answers as $questionCode => $answer) {
            $data = collect($answer)->get('target_answer') ?? collect($answer)->get('achieve_answer');
            $results[$questionCode] = $data;
        }

        // Formula 2
        $formula2Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula2'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula2') as $formula) {
            $valueA = $formula2Answers[$formula[0]]['target_answer'] ?? $formula2Answers[$formula[0]]['achieve_answer'];
            $valueB = $formula2Answers[$formula[1]]['target_answer'] ?? $formula2Answers[$formula[1]]['achieve_answer'];
            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $hasil = $this->formula2(
                $valueA,
                $valueB
            );
            // $answerGroup[] = [
            //     $formula[0] => $valueA,
            //     $formula[1] => $valueB,
            //     $hasilKey => $hasil
            // ];
            $results[$formula[0]] = $valueA;
            $results[$formula[1]] = $valueB;
            $results[$hasilKey] = $hasil;
        }

        // Formula 3
        $formula3Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula3'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula3') as $formula) {
            $n1 = $formula3Answers['IBIK-STD-02.4A-N1']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4A-N1']['achieve_answer'];
            $n2 = $formula3Answers['IBIK-STD-02.4A-N2']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4A-N2']['achieve_answer'];
            $n3 = $formula3Answers['IBIK-STD-02.4A-N3']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4A-N3']['achieve_answer'];
            $ndtps = $formula3Answers['IBIK-STD-02.4A-NDTPS']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4A-NDTPS']['achieve_answer'];
            $skor3A = $this->formula3A($n1, $n2, $n3, $ndtps);
            $results['IBIK-STD-02.4A'] = $skor3A;

            $ni = $formula3Answers['IBIK-STD-02.4B-NI']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4B-NI']['achieve_answer'];
            $nn = $formula3Answers['IBIK-STD-02.4B-NN']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4B-NN']['achieve_answer'];
            $nw = $formula3Answers['IBIK-STD-02.4B-NW']['target_answer'] ?? $formula3Answers['IBIK-STD-02.4B-NW']['achieve_answer'];
            $skor3B = $this->formula3B($ni, $nn, $nw);
            $results['IBIK-STD-02.4B'] = $skor3B;

            $hasil = ((2 * $skor3A) + $skor3B)/3;
            $hasilKey = substr($formula[0], 0, -4) . 'HASIL';
            $results[$hasilKey] = $hasil;
        }

        // Formula 4
        $formula4Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula4'));
        });
        $jp = $formula4Answers['IBIK-STD-03.1-JP']['target_answer'] ?? $formula4Answers['IBIK-STD-03.1-JP']['achieve_answer'];
        $jpl = $formula4Answers['IBIK-STD-03.1-JPL']['target_answer'] ?? $formula4Answers['IBIK-STD-03.1-JPL']['achieve_answer'];

        $hasil = $this->formula4($jp, $jpl);

        $results['IBIK-STD-03.1'] = $hasil;

        // Formula 5
        $formula5Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula5'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula5') as $formula) {
            $valueA = $formula5Answers[$formula[0]]['target_answer'] ?? $formula5Answers[$formula[0]]['achieve_answer'];
            $nma = $formula5Answers[$formula[1]]['target_answer'] ?? $formula5Answers[$formula[1]]['achieve_answer'];
            $nmd = $formula5Answers[$formula[2]]['target_answer'] ?? $formula5Answers[$formula[2]]['achieve_answer'];
            $valueB = $this->formula5B($nma, $nmd);

            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $hasil = $this->formula5(
                $valueA,
                $valueB
            );
            $results[$formula[0]] = $valueA;
            $results[substr($formula[1], 0, -4)] = $valueB;
            $results[$hasilKey] = $hasil;
        }

        // Formula 6
        $formula6Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula6'));
        });

        $ndtps = $formula6Answers['IBIK-STD-04.1-NDTPS']['target_answer'] ?? $formula6Answers['IBIK-STD-04.1-NDTPS']['achieve_answer'];
        $hasilKey = substr('IBIK-STD-04.1-NDTPS', 0, -6) . 'HASIL';
        $hasil = $this->formula6($ndtps);
        $results['IBIK-STD-04.1'] = $hasil;

        // Formula 7
        $formula7Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula7'));
        });

        $nds3 = $formula7Answers['IBIK-STD-04.2-NDS3']['target_answer'] ?? $formula7Answers['IBIK-STD-04.2-NDS3']['achieve_answer'];
        $ndtps = $formula7Answers['IBIK-STD-04.2-NDTPS']['target_answer'] ?? $formula7Answers['IBIK-STD-04.2-NDTPS']['achieve_answer'];
        $hasil = $this->formula7($nds3, $ndtps);
        $results['IBIK-STD-04.2'] = $hasil;

        // Formula 8
        $formula8Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula8'));
        });

        $ndgb = $formula8Answers['IBIK-STD-04.3-NDGB']['target_answer'] ?? $formula8Answers['IBIK-STD-04.3-NDGB']['achieve_answer'];
        $ndlk = $formula8Answers['IBIK-STD-04.3-NDLK']['target_answer'] ?? $formula8Answers['IBIK-STD-04.3-NDLK']['achieve_answer'];
        $ndl = $formula8Answers['IBIK-STD-04.3-NDL']['target_answer'] ?? $formula8Answers['IBIK-STD-04.3-NDL']['achieve_answer'];
        $ndtps = $formula8Answers['IBIK-STD-04.3-NDTPS']['target_answer'] ?? $formula8Answers['IBIK-STD-04.3-NDTPS']['achieve_answer'];
        $hasil = $this->formula8($ndgb, $ndlk, $ndl, $ndtps);
        $results['IBIK-STD-04.3'] = $hasil;

        // Formula 9
        $formula9Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula9'));
        });

        $nm = $formula9Answers['IBIK-STD-04.4-NM']['target_answer'] ?? $formula9Answers['IBIK-STD-04.4-NM']['achieve_answer'];
        $ndtps = $formula9Answers['IBIK-STD-04.4-NDTPS']['target_answer'] ?? $formula9Answers['IBIK-STD-04.4-NDTPS']['achieve_answer'];
        $hasil = $this->formula9($nm, $ndtps);
        $results['IBIK-STD-04.4'] = $hasil;

        // Formula 10
        $formula10Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula10'));
        });

        $rdpu = $formula10Answers['IBIK-STD-04.5-RDPU']['target_answer'] ?? $formula10Answers['IBIK-STD-04.5-RDPU']['achieve_answer'];
        $hasil = $this->formula10($rdpu);
        $results['IBIK-STD-04.5'] = $hasil;

        // Formula 11
        $formula11Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula11'));
        });

        $rewmp = $formula11Answers['IBIK-STD-04.6-REWMP']['target_answer'] ?? $formula11Answers['IBIK-STD-04.6-REWMP']['achieve_answer'];
        $hasil = $this->formula11($rewmp);
        $results['IBIK-STD-04.6'] = $hasil;

        // Formula 12
        $formula12Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula12'));
        });

        $ndtt = $formula12Answers['IBIK-STD-04.7-NDTT']['target_answer'] ?? $formula12Answers['IBIK-STD-04.7-NDTT']['achieve_answer'];
        $ndt = $formula12Answers['IBIK-STD-04.7-NDT']['target_answer'] ?? $formula12Answers['IBIK-STD-04.7-NDT']['achieve_answer'];
        $hasil = $this->formula12($ndtt, $ndt);
        $results['IBIK-STD-04.7'] = $hasil;

        // Formula 13
        $formula13Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), Arr::get($formulas, 'formula13'));
        });

        $nrd = $formula13Answers['IBIK-STD-04.8-NRD']['target_answer'] ?? $formula13Answers['IBIK-STD-04.8-NRD']['achieve_answer'];
        $ndtps = $formula13Answers['IBIK-STD-04.8-NDTPS']['target_answer'] ?? $formula13Answers['IBIK-STD-04.8-NDTPS']['achieve_answer'];
        $hasil = $this->formula13($nrd, $ndtps);
        $results['IBIK-STD-04.8'] = $hasil;

        // Formula 14
        $formula14Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula14'))->collapse()->toArray());
        });


        foreach (Arr::get($formulas, 'formula14') as $formula) {
            $ni = $formula14Answers[$formula[0]]['target_answer'] ?? $formula14Answers[$formula[0]]['achieve_answer'];
            $nn = $formula14Answers[$formula[1]]['target_answer'] ?? $formula14Answers[$formula[1]]['achieve_answer'];
            $nl = $formula14Answers[$formula[2]]['target_answer'] ?? $formula14Answers[$formula[2]]['achieve_answer'];
            $ntps = $formula14Answers[$formula[3]]['target_answer'] ?? $formula14Answers[$formula[3]]['achieve_answer'];

            $hasil = $this->formula14($ni, $nn, $nl, $ntps);
            $hasilKey = substr($formula[0], 0, -3);
            $results [$hasilKey] = $hasil;
        }

        // Formula 15
        $formula15Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula15'));
        });

        $groupAnswer = [];
        foreach ($formula15Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-04.11'] = $this->formula15($groupAnswer);

        // Formula 16
        $formula16Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula16'));
        });

        $groupAnswer = [];
        foreach ($formula16Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'];
        }
        $results['IBIK-STD-04.12'] = $this->formula16($groupAnswer);

        // Formula 17
        $formula17Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula17'));
        });

        $groupAnswer = [];
        foreach ($formula17Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'];
        }
        $results['IBIK-STD-04.13'] = $this->formula17($groupAnswer);

        // Formula 18
        // $formula17Answers = collect($answers)->filter(function ($item) use ($formulas) {
        //     $item = collect($item);
        //     return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula17'));
        // });

        // return $results['IBIK-STD-04.1'];

        // Formula 19
        $formula19Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula19'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula19') as $formula) {
            $valueA = $formula19Answers[$formula[0]]['target_answer'] ?? $formula19Answers[$formula[0]]['achieve_answer'];
            $valueB = $formula19Answers[$formula[1]]['target_answer'] ?? $formula19Answers[$formula[1]]['achieve_answer'];
            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $hasil = $this->formula19(
                $valueA,
                $valueB
            );
            $results[$formula[0]] = $valueA;
            $results[$formula[1]] = $valueB;
            $results[$hasilKey] = $hasil;
        }

        // Formula 20
        $formula20Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula20'));
        });

        $groupAnswer = [];
        foreach ($formula20Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-05.1'] = $this->formula20($groupAnswer);

        // Formula 21
        $formula21Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula21'));
        });

        $groupAnswer = [];
        foreach ($formula21Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-05.2'] = $this->formula21($groupAnswer);

        // Formula 22
        $formula22Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula22'));
        });

        $groupAnswer = [];
        foreach ($formula22Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-05.3'] = $this->formula22($groupAnswer);

        // Formula 24
        $formula24Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula24'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula24') as $formula) {
            $valueA = $formula24Answers[$formula[0]]['target_answer'] ?? $formula24Answers[$formula[0]]['achieve_answer'];
            $valueB = $formula24Answers[$formula[1]]['target_answer'] ?? $formula24Answers[$formula[1]]['achieve_answer'];
            $valueC = $formula24Answers[$formula[2]]['target_answer'] ?? $formula24Answers[$formula[2]]['achieve_answer'];
            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $hasil = $this->formula24(
                $valueA,
                $valueB,
                $valueC
            );
            $results[$formula[0]] = $valueA;
            $results[$formula[1]] = $valueB;
            $results[$formula[2]] = $valueC;
            $results[$hasilKey] = $hasil;
        }

        // Formula 25
        $formula25Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return in_array($item->get('question_id'), collect(Arr::get($formulas, 'formula25'))->collapse()->toArray());
        });

        foreach (Arr::get($formulas, 'formula25') as $formula) {
            $valueA = $formula25Answers[$formula[0]]['target_answer'] ?? $formula25Answers[$formula[0]]['achieve_answer'];
            $valueB = $formula25Answers[$formula[1]]['target_answer'] ?? $formula25Answers[$formula[1]]['achieve_answer'];
            $valueC = $formula25Answers[$formula[2]]['target_answer'] ?? $formula25Answers[$formula[2]]['achieve_answer'];
            $valueD = $formula25Answers[$formula[3]]['target_answer'] ?? $formula25Answers[$formula[2]]['achieve_answer'];
            $valueE = $formula25Answers[$formula[4]]['target_answer'] ?? $formula25Answers[$formula[2]]['achieve_answer'];
            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $hasil = $this->formula25($valueA, $valueB, $valueC, $valueD, $valueE);
            $results[$formula[0]] = $valueA;
            $results[$formula[1]] = $valueB;
            $results[$formula[2]] = $valueC;
            $results[$formula[3]] = $valueD;
            $results[$formula[4]] = $valueE;
            $results[$hasilKey] = $hasil;
        }

        // Formula 26
        $formula26Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula26'));
        });

        $groupAnswer = [];
        foreach ($formula26Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-06.5'] = $this->formula26($groupAnswer);

        // Formula 27
        $formula27Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula27'));
        });

        $groupAnswer = [];
        foreach ($formula27Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-06.8'] = $this->formula27($groupAnswer);

        // Formula 28
        $formula28Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), collect(Arr::get($formulas, 'formula28'))->collapse()->toArray());
        });

        $groupAnswer = [];
        foreach ($formula28Answers as $questionCode => $formula) {
            if (Str::contains($questionCode, 'IBIK-STD-06.10A')) {
                $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
                $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
            }
        }

        foreach (Arr::get($formulas, 'formula28') as $formula) {
            $valueA = $this->formula28A($groupAnswer);
            $valueB = $formula28Answers[$formula[1]]['target_answer'] ?? $formula28Answers[$formula[1]]['achieve_answer'];
            $hasil = $this->formula28($valueA, $valueB);
            $hasilKey = substr($formula[0], 0, -1) . 'HASIL';
            $results[$formula[0]] = $valueA;
            $results[$formula[1]] = $valueB;
            $results[$hasilKey] = $hasil;
        }

        // Formula 29
        $formula29Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula29'));
        });

        $groupAnswer = [];
        foreach ($formula29Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-07.2'] = $this->formula29($groupAnswer);

        // Formula 30
        $formula30Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula30'));
        });

        $groupAnswer = [];
        foreach ($formula30Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-08.2'] = $this->formula30($groupAnswer);

        // Formula 31
        $formula31Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula31'));
        });

        $groupAnswer = [];
        foreach ($formula31Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.2'] = $this->formula31($groupAnswer);

        // Formula 32
        $formula32Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula32'));
        });

        $groupAnswer = [];
        foreach ($formula32Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.3'] = $this->formula32($groupAnswer);

        // Formula 33
        $formula33Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula33'));
        });

        $groupAnswer = [];
        foreach ($formula33Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.4'] = $this->formula33($groupAnswer);

        // Formula 34
        $formula34Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula34'));
        });

        $groupAnswer = [];
        foreach ($formula34Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.5'] = $this->formula34($groupAnswer);

        // Formula 35
        $formula35Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula35'));
        });

        $groupAnswer = [];
        foreach ($formula35Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.6'] = $this->formula35($groupAnswer);

        // Formula 36
        $formula36Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula36'));
        });

        $groupAnswer = [];
        foreach ($formula36Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.7'] = $this->formula36($groupAnswer);

        // Formula 37
        $formula37Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula37'));
        });

        $groupAnswer = [];
        foreach ($formula37Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.9'] = $this->formula37($groupAnswer);

        // Formula 38
        $formula38Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula38'));
        });

        $groupAnswer = [];
        foreach ($formula38Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.10'] = $this->formula38($groupAnswer);

        // Formula 39
        $formula39Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula39'));
        });

        $groupAnswer = [];
        foreach ($formula39Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.11'] = $this->formula39($groupAnswer);

        // Formula 40
        $formula40Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula40'));
        });

        $groupAnswer = [];
        foreach ($formula40Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.12'] = $this->formula40($groupAnswer);

        // Formula 41
        $formula41Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula41'));
        });

        $groupAnswer = [];
        foreach ($formula41Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.13'] = $this->formula41($groupAnswer);

        // Formula 42
        $formula42Answers = collect($answers)->filter(function ($item) use ($formulas) {
            $item = collect($item);
            return Str::contains($item->get('question_id'), Arr::get($formulas, 'formula42'));
        });

        $groupAnswer = [];
        foreach ($formula42Answers as $questionCode => $formula) {
            $varKey = substr($questionCode, strrpos($questionCode, '-') + 1);
            $groupAnswer[$varKey] = $formula['target_answer'] ?? $formula['achieve_answer'];
        }
        $results['IBIK-STD-09.14'] = $this->formula42($groupAnswer);

        return $results;

    }


    public function formula1(int $values)
    {
        return $values;
    }

    public function formula2($value_a, $value_b)
    {
        return ($value_a + (2 * $value_b)) / 3;
    }

    public function formula3A(int $n1, int $n2, int $n3, int $ndtps)
    {
            $a = 3;
            $b = 2;
            $c = 1;

            if ($ndtps > 0) {
                $RK = (($a * $n1) + ($b * $n2) + ($c * $n3)) / $ndtps;
            } else {
                $RK = 0;
            }

            return $RK >= 4 ? 4 : $RK;
    }

    public function formula3B(int $ni, int $nn, int $nw)
    {
        $a = 2;
        $b = 6;
        $c = 9;

        if ($ni >= $a) {
            $skorB = 4;
        } elseif ($ni < $a && $nn >= $b) {
            $skorB = 3 + ($ni / $a);
        } elseif (0 < $ni && $ni < $a && 0 < $nn && $nn < $b) {
            $skorB = 2 + (2 * ($ni / $a)) + ($nn / $b) - (($ni * $nn) / ($a * $b));
        } elseif ($ni == 0 && $nn == 0 && $nw >= $c) {
            $skorB = 2;
        } elseif ($ni == 0 && $nn == 0 && $nw < $c) {
            $skorB = (2 * $nw) / $c;
        }

        return $skorB;
    }

    public function formula4(int $jp, int $jpl)
    {
        $JP = $jp ?? 0;
        $JPL = $jpl ?? 0;

        if ($JPL > 0) {
            $rasio = $JPL / $JP;
        } else {
            $rasio = 0;
        }

        if ($rasio < 5) {
            $skor = (4 * $rasio) / 5;
        } else {
            $skor = 4;
        }

        return $skor;
    }

    public function formula5B(int $nma, int $nmd)
    {

        $NMA = $nma ?? 0;
        $NMD = $nmd ?? 0;

        $PMA = $NMA / $NMD;

        if ($PMA < 1) {
            $skorB = 2 + (200 * $PMA);
        } else {
            $skorB = 4;
        }

        return $skorB;
    }

    public function formula5(int $value_a, $value_b)
    {
        return ((2 * $value_a) + $value_b) / 3;
    }

    public function formula6(int $ndtps)
    {
        $NDTPS = $ndtps ?? 0;
        if ($NDTPS < 3) {
            $skor = 0;
        } elseif (3 <= $NDTPS && $NDTPS < 12) {
            $skor = ((2 * $NDTPS) + 12) / 9;
        } elseif ($NDTPS >= 12) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula7(int $nds3, int $ndtps)
    {
        $NDS3 = $nds3 ?? 0;
        $NDTPS = $ndtps ?? 0;

        $PDS3 = $NDS3 / $NDTPS * 100;

        if ($PDS3 < 50) {
            $skor = 2 + (4 * $PDS3) / 100;
        } elseif ($PDS3 >= 50) {
            $skor = 4;
        }

        return $skor;
    }

    public function formula8(int $ndgb, int $ndlk, int $ndl, int $ndtps)
    {
        $NDGB = $ndgb ?? 0;
        $NDLK = $ndlk ?? 0;
        $NDL = $ndl ?? 0;
        $NDTPS = $ndtps ?? 0;

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

    public function formula9(int $nm, int $ndtps)
    {
        $NM = $nm ?? 0;
        $NDTPS = $ndtps ?? 0;

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

    public function formula10(int $rdpu)
    {
        $RDPU = $rdpu ?? 0;
        if (6 < $RDPU && $RDPU <= 10) {
            $skor = 7 - ($RDPU / 2);
        } elseif ($RDPU <= 6) {
            $skor = 4;
        } elseif ($RDPU > 10) {
            $skor = 0;
        }

        return $skor;
    }

    public function formula11(int $rewmp)
    {
        $REWMP = $rewmp ?? 0;

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

    public function formula12(int $ndtt, int $ndt)
    {
        $NDTT = $ndtt ?? 0;
        $NDT = $ndt ?? 0;

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

    public function formula13(int $nrd, int $ndtps)
    {
        $NRD = $nrd ?? 0;
        $NDTPS = $ndtps ?? 0;

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

    public function formula14(int $ni, int $nn, int $nl, int $ntps)
    {
        $a = 0.05;
        $b = 0.3;
        $c = 1;

        $NI = $ni ?? 0;
        $NN = $nn ?? 0;
        $NL = $nl ?? 0;
        $NDTPS = $ntps ?? 0;

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

    public function formula18($values)
    {

    }

    public function formula19($value_a, $value_b)
    {
        return ($value_a + $value_b) / 2;
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

    public function formula24($value_a, $value_b, $value_c)
    {
        return ($value_a + (2 * $value_b) + (2 * $value_c)) / 5;
    }

    public function formula25($value_a, $value_b, $value_c, $value_d, $value_e)
    {
        return ($value_a + (2 * $value_b) + (2 * $value_c) + (2 * $value_d) + (2 * $value_e)) / 9;
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

    public function formula28A($values)
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
            $skorA = (8 * ($tkm/100)) - 2;
        } elseif ($tkm >= 75) {
            $skorA = 4;
        }

        return $skorA;
    }

    public function formula28($value_a, $value_b)
    {
        return ($value_a + (2 * $value_b)) / 3;
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
