<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobTitleController extends Controller
{
    public function index()
    {
        return Inertia::render('JobTitle/Index', [
            'jobTitles' => JobTitle::paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('JobTitle/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        JobTitle::create($request->all());

        return redirect()->route('job-titles.index');
    }

    public function show($id)
    {
        Inertia::render('JobTitle/Show', [
            'jobTitle' => JobTitle::find($id),
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('JobTitle/Edit', [
            'jobTitle' => JobTitle::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        JobTitle::find($id)->update($request->all());

        return redirect()->route('job-titles.index');
    }

    public function destroy($id)
    {
        JobTitle::find($id)->delete();

        return redirect()->route('job-titles.index');
    }

    public function addUser(Request $request, $id)
    {
        $jobTitle = JobTitle::find($id);
        $jobTitle->users()->attach($request->user_id);

        return redirect()->route('job-titles.show', $id);
    }

    public function removeUser(Request $request, $id)
    {
        $jobTitle = JobTitle::find($id);
        $jobTitle->users()->detach($request->user_id);

        return redirect()->route('job-titles.show', $id);
    }
}
