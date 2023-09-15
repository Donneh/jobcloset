<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToDepartmentRequest;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Department/Index', [
            'departments' => $departments,
        ]);
    }

    public function create()
    {
        return Inertia::render('Department/Create');
    }

    public function edit(Department $department)
    {
        return Inertia::render('Department/Edit', [
            'department' => $department,
        ]);
    }

    public function store(CreateDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('department.index');
    }

    public function show(Department $department)
    {
        $department->load('users');
        $users = User::all();
        return Inertia::render('Department/Show', [
            'department' => $department,
            'users' => $users,
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('department.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('department.index');
    }

    public function addUser(AddUserToDepartmentRequest $request, Department $department)
    {
        $request->validated();

        $user = User::where('id', $request->user_id)->first();

        $department->users()->attach($user);

        return redirect()->route('department.show', $department);
    }

    public function removeUser(Request $request, Department $department)
    {
        $request->validate([
            'user_id' => ['required', 'exists:department_user,user_id'],
        ]);

        $user = User::find($request->user_id);

        $department->users()->detach($user);

        return redirect()->route('department.show', $department);
    }
}
