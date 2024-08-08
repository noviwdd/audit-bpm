<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('management-user.index', ['data' => $data]);
    }

    public function store(Request $request, $id = null)
    {
        User::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $request->name
            ]
        );

        return redirect()->route('management-user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('management-user.index');
    }
}
