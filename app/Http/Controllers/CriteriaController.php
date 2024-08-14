<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        return view('criteria.index')->with('data', $criteria);
    }

    public function store(Request $request, $id = null)
    {
        Criteria::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $request->name
            ]
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        return redirect()->route('criteria.index');
    }
}
