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

        $user = User::where('email', $request->email)->first();

        $department->users()->attach($user);

        return redirect()->route('department.show', $department);
    }
}
