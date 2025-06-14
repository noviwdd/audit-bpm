<?php

namespace App\Http\Controllers;

use App\Models\PerformanceUnit;
use App\Models\Unit;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Diatria\LaravelInstant\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerformanceUnitImport;

class PerformanceUnitController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $rowCreated = $this->createNewRows($request);
        if ($rowCreated) return redirect()->route('performance-unit.create');

        $allUnits = Unit::all();
        $unitId = $request->input('unit_id', Auth::user()->unit_id);
        $unit = Unit::where('id', $unitId)->first();

        $data = PerformanceUnit::where('unit_id', $unitId)
            ->where('year', $selectedYear)
            ->orderBy('index_position')->get();

        $years = range(date('Y'), date('Y') - 5);
        $role_name = Role::find(Auth::user()->role_id)->name;
        $criteriaList = Criteria::all();
        $subCriteriaList = SubCriteria::all();

        return view('performance-unit.index', compact(
            'data', 'unit', 'selectedYear', 'years', 'role_name', 'criteriaList', 'subCriteriaList', 'allUnits'
        ));
    }

    public function createNewRows(Request $request)
    {
        DB::beginTransaction();
        try {
            $rowCreated = null;
            if ($request->has('add_above')) {
                $findIndex = PerformanceUnit::find($request->add_above);
                $willBeChanges = PerformanceUnit::where('parent_id', $request->parent_id ?? null)
                    ->where('index_position', '>=', $findIndex->index_position)->get();

                foreach ($willBeChanges as $item) {
                    $item->update(['index_position' => $item->index_position + 1]);
                }

                $rowCreated = PerformanceUnit::create([
                    'unit_id' => Auth::user()->unit_id,
                    'year' => date('Y'),
                    'index_position' => $findIndex->index_position
                ]);
            }

            if ($request->has('add_below')) {
                $findIndex = PerformanceUnit::find($request->add_below);
                $willBeChanges = PerformanceUnit::where('parent_id', $request->parent_id ?? null)
                    ->where('index_position', '>', $findIndex->index_position)->get();

                foreach ($willBeChanges as $item) {
                    $item->update(['index_position' => $item->index_position + 1]);
                }

                $rowCreated = PerformanceUnit::create([
                    'unit_id' => Auth::user()->unit_id,
                    'year' => date('Y'),
                    'index_position' => $findIndex->index_position + 1
                ]);
            }

            DB::commit();
            return $rowCreated;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function create(Request $request)
    {
        $latestIndex = PerformanceUnit::where('parent_id', null)
                            ->orderByDesc('index_position')->pluck('index_position')->first() ?? 0;

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        $data = [
            'work_planning' => $request->work_planning,
            'unit_id' => Auth::user()->unit_id,
            'year' => $request->input('year', date('Y')),
            'target' => $request->target,
            'achieve' => $request->achieve,
            'time_target' => $request->time_target,
            'document' => $documentPath,
            'index_position' => $latestIndex + 1,
        ];

        $role = Role::find(Auth::user()->role_id)->name;
        if (in_array($role, ['Auditor', 'Super Admin'])) {
            $data['criteria_id'] = $request->criteria_id;
            $data['sub_criteria_id'] = $request->sub_criteria_id;
            $data['evaluation_score'] = (int) $request->evaluation_score;
            $data['evaluation_auto'] = false;
            $data['description'] = $request->note;
        } else {
            // Auto suggest untuk Unit
            if (is_numeric($data['target']) && is_numeric($data['achieve'])) {
                $target = (float) $data['target'];
                $achieve = (float) $data['achieve'];
                $percent = $target > 0 ? ($achieve / $target) * 100 : 0;

                if ($percent <= 25) {
                    $data['evaluation_score'] = 0;
                } elseif ($percent <= 50) {
                    $data['evaluation_score'] = 1;
                } elseif ($percent <= 75) {
                    $data['evaluation_score'] = 2;
                } elseif ($percent < 100) {
                    $data['evaluation_score'] = 3;
                } else {
                    $data['evaluation_score'] = 4;
                }
                $data['evaluation_auto'] = true;
            }
        }

        PerformanceUnit::create($data);

        return redirect()->route('performance-unit.index', [
            'year' => $request->input('year', date('Y')),
            'unit_id' => $request->input('unit_id')
        ]);
    }

    public function update(Request $request, int $id)
    {
        $performanceUnit = PerformanceUnit::findOrFail($id);
        $documentPath = $performanceUnit->document;

        if ($request->hasFile('document')) {
            if ($documentPath && Storage::exists('public/' . $documentPath)) {
                Storage::delete('public/' . $documentPath);
            }
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        $data = [
            'work_planning' => $request->work_planning,
            'target' => $request->target,
            'achieve' => $request->achieve,
            'time_target' => $request->time_target,
            'document' => $documentPath,
        ];

        $role = Role::find(Auth::user()->role_id)->name;
        if (in_array($role, ['Auditor', 'Super Admin'])) {
            $data['criteria_id'] = $request->criteria_id;
            $data['sub_criteria_id'] = $request->sub_criteria_id;
            $data['evaluation_score'] = (int) $request->evaluation_score;
            $data['evaluation_auto'] = false;
            $data['description'] = $request->note;
        } else {
            if (is_numeric($data['target']) && is_numeric($data['achieve'])) {
                $target = (float) $data['target'];
                $achieve = (float) $data['achieve'];
                $percent = $target > 0 ? ($achieve / $target) * 100 : 0;

                if ($percent <= 25) {
                    $data['evaluation_score'] = 0;
                } elseif ($percent <= 50) {
                    $data['evaluation_score'] = 1;
                } elseif ($percent <= 75) {
                    $data['evaluation_score'] = 2;
                } elseif ($percent < 100) {
                    $data['evaluation_score'] = 3;
                } else {
                    $data['evaluation_score'] = 4;
                }
                $data['evaluation_auto'] = true;
            }
        }

        $performanceUnit->update($data);

        return redirect()->route('performance-unit.index', [
            'year' => $request->input('year', date('Y')),
            'unit_id' => $request->input('unit_id')
        ]);
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $deletedItem = PerformanceUnit::findOrFail($id);
            $deletedIndexPosition = $deletedItem->index_position;

            $deletedItem->delete();

            PerformanceUnit::where('parent_id', $deletedItem->parent_id)
                ->where('index_position', '>', $deletedIndexPosition)
                ->decrement('index_position');

            DB::commit();

            return redirect()->route('performance-unit.index', ['year' => $request->input('year', date('Y'))])
                            ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('performance-unit.index')
                            ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $year = $request->input('year', date('Y'));
        Excel::import(new PerformanceUnitImport($year), $request->file('import_file'));

        return redirect()->route('performance-unit.index', ['year' => $year])
                        ->with('success', 'Data berhasil diimpor.');
    }

    public function evaluasiReport(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $selectedUnitId = $request->input('unit_id', Auth::user()->unit_id);

        $data = PerformanceUnit::with('subCriteria.criteria')
            ->where('unit_id', $selectedUnitId)
            ->where('year', $selectedYear)
            ->orderBy('index_position')
            ->get();

        $units = Unit::all();
        $criteria = Criteria::all();
        $years = range(date('Y'), date('Y') - 5);

        $tableData = $data->map(function ($item) {
            $criteriaName = $item->subCriteria->criteria->name ?? '-';
            $subCriteriaName = $item->subCriteria->name ?? '-';
            $target = (float) $item->target;
            $achieve = (float) $item->achieve;
            $percent = $target > 0 ? ($achieve / $target) * 100 : 0;

            $sebutanMap = [
                0 => ['Sangat Kurang', '[#D32F2F]'],
                1 => ['Kurang', '[#FF9800]'],
                2 => ['Cukup', 'amber'],
                3 => ['Baik', 'teal'],
                4 => ['Sangat Baik', 'caribbean'],
            ];
            $score = is_numeric($item->evaluation_score) ? (int) $item->evaluation_score : 0;
            $sebutan = $sebutanMap[$score][0];
            $sebutanClass = $sebutanMap[$score][1];

            $ketercapaian = '';
            if ($target > $achieve || ($target == 0 && $achieve == 0)) {
                $ketercapaian = 'Tidak Tercapai';
                $ketercapaianClass = '[#D32F2F]';
            } elseif ($target == $achieve) {
                $ketercapaian = 'Tercapai';
                $ketercapaianClass = 'cerulean';
            } elseif ($target < $achieve) {
                $ketercapaian = 'Terlampaui';
                $ketercapaianClass = 'caribbean';
            }

            return [
                'criteria_id' => $item->criteria_id,
                'criteria_name' => $criteriaName,
                'sub_criteria_name' => $subCriteriaName,
                'work_planning' => $item->work_planning,
                'target_score' => $item->target,
                'achieve_score' => $item->achieve,
                'sebutan' => $sebutan,
                'sebutan_class' => $sebutanClass,
                'ketercapaian' => $ketercapaian,
                'ketercapaian_class' => $ketercapaianClass,
            ];
        });

        $total = $data->count();
        $jumlahTerlampaui = $data->filter(function ($item) {
            return (float)$item->achieve > (float)$item->target;
        })->count();

        $jumlahTercapai = $data->filter(function ($item) {
            return (float)$item->achieve == (float)$item->target;
        })->count();

        $jumlahTidakTercapai = $data->filter(function ($item) {
            return (float)$item->achieve < (float)$item->target;
        })->count();

        $persentaseTerlampaui = $total > 0 ? round(($jumlahTerlampaui / $total) * 100, 0) : 0;
        $persentaseTercapai = $total > 0 ? round(($jumlahTercapai / $total) * 100, 0) : 0;
        $persentaseTidakTercapai = $total > 0 ? round(($jumlahTidakTercapai / $total) * 100, 0) : 0;

        return view('performance-unit.evaluasi-report', compact(
            'tableData', 'criteria', 'units', 'years',
            'selectedYear', 'selectedUnitId', 'persentaseTerlampaui', 'persentaseTercapai', 'persentaseTidakTercapai'
        ));
    }

}
