<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Diatria\LaravelInstant\Models\Role;

class ManagementUserController extends Controller
{
    public function index()
    {
        $data = User::with(['unit', 'role'])->get();
        return view('management-user.index', [
            'data' => $data,
            'units' => Unit::all(),
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request, $id = null)
    {
        $field = collect([
            'name' => $request->name,
            'email' => $request->email,
            'unit_id' => $request->unit_id,
            'role_id' => $request->role_id
        ]);
        if (!$id) $field->put('password', bcrypt(env("PASSWORD_DEFAULT", 123456)));
        if ($id && $request->has('password')) {
            $field->put('password', $request->password);
        }

        User::updateOrCreate(
            [
                'id' => $id
            ],
            $field->toArray()
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
