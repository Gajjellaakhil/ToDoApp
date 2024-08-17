<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('todos')->get();
        return view('groups.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Group::create($request->all());
        return redirect()->route('groups.index');
    }

    public function update(Request $request, Group $group)
    {
        $request->validate(['name' => 'required']);
        $group->update($request->all());
        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index');
    }
}
