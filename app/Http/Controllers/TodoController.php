<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'group_id' => 'required|exists:groups,id',
        ]);
        Todo::create($request->all());
        return redirect()->route('groups.index');
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate(['title' => 'required']);
        $todo->update($request->all());
        return redirect()->route('groups.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('groups.index');
    }

    public function toggleComplete(Todo $todo)
    {
        $todo->is_complete = !$todo->is_complete;
        $todo->save();
        return redirect()->route('groups.index');
    }
}
