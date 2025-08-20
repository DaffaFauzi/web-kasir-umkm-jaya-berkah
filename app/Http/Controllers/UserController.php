<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('user.index', compact('users'));
}

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
}

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/user')->with('success', 'User dihapus!');
    }
}