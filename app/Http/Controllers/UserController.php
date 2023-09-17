<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create', [
            'status' => session('status')
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('user.create')->with('status', 'User created.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('status', 'User deleted.');
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user,
            'status' => session('status')
        ]);
    }
}
