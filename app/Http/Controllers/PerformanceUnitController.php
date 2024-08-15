<?php

namespace App\Http\Controllers;

use App\Models\PerformanceUnit;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerformanceUnitController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $rowCreated = $this->createNewRows($request);
        if ($rowCreated) return redirect()->route('performance-unit.create');
        $unit = Unit::where('id', Auth::user()->unit_id)->first();
        $data = PerformanceUnit::where('unit_id', Auth::user()->unit_id)->where('year', $selectedYear)->orderBy('index_position')->get();
        $years = range(date('Y'), date('Y') - 5);
        return view('performance-unit.index', [
            'data' => $data,
            'unit' => $unit,
            'selectedYear' => $selectedYear,
            'years' => $years
        ]);
    }

    public function createNewRows(Request $request)
    {
        DB::beginTransaction();
        try {
            $rowCreated = null;
            if ($request->has('add_above')) {
                $findInexPosition = PerformanceUnit::find($request->add_above);
                $willBeChanges = PerformanceUnit::where('parent_id', $request->parent_id ?? null)->where('index_position', '>=', $findInexPosition->index_position)->get();
                foreach ($willBeChanges as $item) {
                    PerformanceUnit::find($item->id)->update(['index_position' => $item->index_position + 1]);
                }

                $rowCreated = PerformanceUnit::create([
                    'unit_id' => Auth::user()->unit_id,
                    'year' => 2024,
                    'index_position' => $findInexPosition->index_position
                ]);
            }

            if ($request->has('add_below')) {
                $findInexPosition = PerformanceUnit::find($request->add_below);
                $willBeChanges = PerformanceUnit::where('parent_id', $request->parent_id ?? null)->where('index_position', '>', $findInexPosition->index_position)->get();
                foreach ($willBeChanges as $item) {
                    PerformanceUnit::find($item->id)->update(['index_position' => $item->index_position + 1]);
                }

                $rowCreated = PerformanceUnit::create([
                    'unit_id' => Auth::user()->unit_id,
                    'year' => 2024,
                    'index_position' => $findInexPosition->index_position + 1
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
        $latestIndexPoisition = PerformanceUnit::where('parent_id', null)->orderByDesc('index_position')->pluck('index_position');
        PerformanceUnit::create([
            'work_planning' => $request->work_planning,
            'unit_id' => Auth::user()->unit_id,
            'year' => 2024,
            'target' => $request->target,
            'achieve' => $request->achieve,
            'time_target' => $request->time_target,
            'document' => $request->document,
            'index_position' => collect($latestIndexPoisition)->first() + 1 ?? 1
        ]);

        return redirect()->route('performance-unit.create');
    }

    public function update(Request $request, int $id) {
        PerformanceUnit::find($id)->update([
            'work_planning' => $request->work_planning,
            'target' => $request->target,
            'achieve' => $request->achieve,
            'time_target' => $request->time_target,
            'document' => $request->document,
        ]);

        return redirect()->route('performance-unit.create');
    }

    public function destroy($id)
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

            return redirect()->route('performance-unit.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('performance-unit.index')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
