<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        $subCriteria = SubCriteria::with('criteria')->get();
        return view('sub-criteria.index')->with([
            'data' => $subCriteria,
            'criterias' => $criteria
        ]);
    }

    public function store(Request $request, $id = null)
    {
        SubCriteria::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'criteria_id' => $request->criteria_id,
                'name' => $request->name,
            ]
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->delete();

        return redirect()->route('criteria.index');
    }
}
