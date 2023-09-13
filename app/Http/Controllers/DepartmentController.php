<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return Department::all();
    }

    public function store(CreateDepartmentRequest $request)
    {
        return Department::create($request->validated());
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $department->update($request->validated());

        return $department;
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json();
    }
}
