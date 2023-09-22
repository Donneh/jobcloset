<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();

        return Inertia::render('User/Create', [
            'status' => session('status'),
            'roles' => $roles->map->only(['id', 'name'])
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated())->assignRole($request->role ?? 'employee');

        return redirect()->route('users.create')->with('status', 'User created.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User deleted.');
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => ['data' => $user, 'role' => $user->getRoleNames()->first()],
            'status' => session('status'),
            'roles' => Role::all()->map->only(['id', 'name'])
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user)],
            'role' => ['string', Rule::in(['manager', 'employee'])],
        ]);

        $user->update($request->only(['name', 'email']));

        $role = Role::where('name', $request->input('role'))->first();

        if ($role) {
            $user->syncRoles([$role->name]);
        }

        return redirect()->route('users.index')->with('status', 'User updated.');
    }


    public function show(User $user)
    {
        $user->load('locations', 'jobTitles', 'departments');
        $userData = [];
        $userData = $user->only(['id', 'name', 'email']);
        $userData['locations'] = $user->locations;
        $userData['jobTitles'] = $user->jobTitles;
        $userData['departments'] = $user->departments;
        return Inertia::render('User/Show', [
            'user' => $userData,
        ]);
    }
}
