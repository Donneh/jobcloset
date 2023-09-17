<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index()
    {
        return Inertia::render('Location/Index', [
            'locations' => Location::paginate(10),
        ]);

    }

    public function create()
    {
        return Inertia::render('Location/Create');
    }

    public function store(Request $request)
    {
        Location::create($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('locations.index');
    }

    public function show($id)
    {
        $location = Location::find($id)->load('users');
        $users = User::all();
        return Inertia::render('Location/Show', [
            'location' => $location,
            'users' => $users,
        ]);
    }

   public function edit($id)
    {
        return Inertia::render('Location/Edit', [
            'location' => Location::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        Location::find($id)->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('locations.index');
    }

    public function destroy($id)
    {
        Location::find($id)->delete();

        return redirect()->route('locations.index');
    }

    public function addUser(Request $request, $id)
    {
        $location = Location::find($id);
        $location->users()->attach($request->user_id);

        return redirect()->route('locations.show', $id);
    }

    public function removeUser(Request $request, $id)
    {
        $location = Location::find($id);
        $location->users()->detach($request->user_id);

        return redirect()->route('locations.show', $id);
    }
}
