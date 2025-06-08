<?php

namespace App\Imports;

use App\Models\PerformanceUnit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class PerformanceUnitImport implements ToCollection
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection(Collection $rows)
    {
        $headerSkipped = false;

        foreach ($rows as $row) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            $data = $row->toArray();

            $validator = Validator::make($data, [
                '0' => 'required|string|max:255',      // work_planning
                '1' => 'required|numeric',              // target
                '2' => 'required|numeric',              // achieve
                '3' => 'required|date_format:Y-m-d',    // time_target
            ]);

            if ($validator->fails()) {
                continue;
            }

            $target = (float) $data[1];
            $achieve = (float) $data[2];
            $evaluation_score = null;
            $evaluation_auto = null;

            if ($target > 0) {
                $percent = ($achieve / $target) * 100;

                if ($percent <= 25) {
                    $evaluation_score = 0;
                } elseif ($percent <= 50) {
                    $evaluation_score = 1;
                } elseif ($percent <= 75) {
                    $evaluation_score = 2;
                } elseif ($percent < 100) {
                    $evaluation_score = 3;
                } else {
                    $evaluation_score = 4;
                }

                $evaluation_auto = true;
            }

            PerformanceUnit::create([
                'unit_id'           => Auth::user()->unit_id,
                'year'              => $this->year,
                'work_planning'     => $data[0],
                'target'            => $target,
                'achieve'           => $achieve,
                'time_target'       => $data[3],
                'document'          => null,
                'evaluation_score'  => $evaluation_score,
                'evaluation_auto'   => $evaluation_auto,
                'index_position'    => PerformanceUnit::where('unit_id', Auth::user()->unit_id)->max('index_position') + 1,
            ]);
        }
    }
}
