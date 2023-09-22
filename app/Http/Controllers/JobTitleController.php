<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobTitleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(JobTitle::class, 'job_title');
    }

    public function index()
    {
        $jobTitles = JobTitle::orderBy('created_at', 'desc')->get();
        return Inertia::render('JobTitle/Index', [
            'jobTitles' => $jobTitles->map->only('id', 'name'),
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

    public function show(JobTitle $jobTitle)
    {
        $jobTitle->load('users');
        return Inertia::render('JobTitle/Show', [
            'jobTitle' => $jobTitle,
            'users' => User::all(),
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
