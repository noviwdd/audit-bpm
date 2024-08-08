<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagementUnit;
use App\Models\Unit;

class ManagementUnitController extends Controller
{
    public function index()
    {
        $data = Unit::all();
        return view('management-unit.index', ['data' => $data]);
    }

    public function store(Request $request, $id = null)
    {
        Unit::updateOrCreate(
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
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('management-unit.index');
    }
}
