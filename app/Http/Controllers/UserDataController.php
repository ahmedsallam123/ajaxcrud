<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;

class UserDataController extends Controller
{
    public function index()
    {
        return view('userdata');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:user_data,email',
    ]);

    $user = UserData::create($validated);

    return response()->json(['success' => 'User added!', 'data' => $user]);
}


    public function fetchAll()
    {
        $users = UserData::all();
        return response()->json($users);
    }

    public function update(Request $request, $id)
    {
    $user = UserData::find($id);

    if ($user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_data,email,' . $id,
        ]);

        $user->update($validated);

        return response()->json(['success' => 'User updated!', 'data' => $user]);
    }

    return response()->json(['error' => 'User not found'], 404);
    }


    public function destroy($id)
    {
        $user = UserData::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User deleted']);
        }
        return response()->json(['error' => 'User not found'], 404);
    }
}

