<?php

namespace App\Imports;

use App\Models\PerformanceUnit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

        foreach ($rows as $index => $row) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            $validator = Validator::make($row->toArray(), [
                '0' => 'required|string|max:255',      // work_planning
                '1' => 'required|numeric',              // target
                '2' => 'required|numeric',              // achieve
                '3' => 'required|date_format:Y-m-d',    // time_target
            ]);

            if ($validator->fails()) continue;

            $target = (float) $row[1];
            $achieve = (float) $row[2];
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
                'unit_id' => Auth::user()->unit_id,
                'year' => $this->year,
                'work_planning' => $row[0],
                'target' => $target,
                'achieve' => $achieve,
                'time_target' => $row[3],
                'document' => null,
                'evaluation_score' => $evaluation_score,
                'evaluation_auto' => $evaluation_auto,
                'index_position' => PerformanceUnit::where('unit_id', Auth::user()->unit_id)->max('index_position') + 1,
            ]);
        }
    }
}
